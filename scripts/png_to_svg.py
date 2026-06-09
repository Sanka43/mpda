"""Trace logo PNG to layered SVG paths."""
from __future__ import annotations

from pathlib import Path

import cv2
import numpy as np


def contours_to_paths(contours, min_area: float, epsilon_factor: float) -> list[str]:
    paths: list[str] = []
    for cnt in contours:
        if cv2.contourArea(cnt) < min_area:
            continue
        epsilon = epsilon_factor * cv2.arcLength(cnt, True)
        approx = cv2.approxPolyDP(cnt, epsilon, True)
        if len(approx) < 3:
            continue
        pts = approx.reshape(-1, 2)
        d = f"M {pts[0][0]:.1f} {pts[0][1]:.1f}"
        for x, y in pts[1:]:
            d += f" L {x:.1f} {y:.1f}"
        d += " Z"
        paths.append(d)
    return paths


def trace_to_svg(png_path: Path, svg_path: Path, max_dim: int = 1200) -> None:
    img = cv2.imread(str(png_path), cv2.IMREAD_UNCHANGED)
    if img is None:
        raise SystemExit(f"Cannot read {png_path}")

    h, w = img.shape[:2]
    scale = min(1.0, max_dim / max(h, w))
    if scale < 1.0:
        img = cv2.resize(
            img,
            (int(w * scale), int(h * scale)),
            interpolation=cv2.INTER_AREA,
        )
        h, w = img.shape[:2]

    if img.shape[2] == 4:
        bgr = img[:, :, :3]
        alpha = img[:, :, 3]
        gray = cv2.cvtColor(bgr, cv2.COLOR_BGR2GRAY)
        gray = np.where(alpha < 20, 0, gray).astype(np.uint8)
    else:
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    kernel = cv2.getStructuringElement(cv2.MORPH_ELLIPSE, (2, 2))
    _, base_mask = cv2.threshold(gray, 34, 255, cv2.THRESH_BINARY)
    base_mask = cv2.morphologyEx(base_mask, cv2.MORPH_CLOSE, kernel, iterations=2)

    _, shine_mask = cv2.threshold(gray, 118, 255, cv2.THRESH_BINARY)
    shine_mask = cv2.subtract(shine_mask, base_mask)
    shine_mask = cv2.morphologyEx(shine_mask, cv2.MORPH_OPEN, kernel, iterations=1)

    min_area = (h * w) * 0.000008
    base_cnt, _ = cv2.findContours(base_mask, cv2.RETR_TREE, cv2.CHAIN_APPROX_SIMPLE)
    shine_cnt, _ = cv2.findContours(shine_mask, cv2.RETR_TREE, cv2.CHAIN_APPROX_SIMPLE)

    base_paths = contours_to_paths(base_cnt, min_area, 0.00085)
    shine_paths = contours_to_paths(shine_cnt, min_area * 2.5, 0.0012)

    svg = f'''<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {w} {h}" role="img" aria-label="Menaka Peiris Dancing Academy">
  <title>Menaka Peiris Dancing Academy</title>
  <defs>
    <linearGradient id="gold" x1="0%" y1="0%" x2="0%" y2="100%">
      <stop offset="0%" stop-color="#FFF4C4"/>
      <stop offset="35%" stop-color="#E8C84A"/>
      <stop offset="65%" stop-color="#C9A227"/>
      <stop offset="100%" stop-color="#6B4A12"/>
    </linearGradient>
    <linearGradient id="goldShine" x1="0%" y1="0%" x2="100%" y2="0%">
      <stop offset="0%" stop-color="#B8942A"/>
      <stop offset="40%" stop-color="#FFFBE6"/>
      <stop offset="60%" stop-color="#FFFBE6"/>
      <stop offset="100%" stop-color="#B8942A"/>
    </linearGradient>
  </defs>
  <rect width="{w}" height="{h}" fill="#000"/>
  <g fill="url(#gold)" fill-rule="evenodd">
'''
    for d in base_paths:
        svg += f'    <path d="{d}"/>\n'
    svg += '  </g>\n  <g fill="url(#goldShine)" fill-rule="evenodd" opacity="0.85">\n'
    for d in shine_paths:
        svg += f'    <path d="{d}"/>\n'
    svg += "  </g>\n</svg>\n"

    svg_path.write_text(svg, encoding="utf-8")
    print(
        f"Wrote {svg_path} ({len(base_paths)} base + {len(shine_paths)} shine paths, {w}x{h})"
    )


if __name__ == "__main__":
    root = Path(__file__).resolve().parents[1]
    trace_to_svg(
        root / "assets" / "images" / "logo.png",
        root / "assets" / "images" / "logo.svg",
    )
