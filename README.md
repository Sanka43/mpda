# MPDA Website

Menaka Peiris Dancing Academy — PHP website with gallery, registrations, and bilingual content.

Repository: https://github.com/Sanka43/mpda

---

## GitHub Pages

Site URL: https://sanka43.github.io/mpda/

GitHub Pages **PHP run කරන්නේ නැහ**. Static HTML files auto-generate වෙනවා:

```bash
php scripts/build-static.php
```

Push කළාම GitHub Actions workflow (`.github/workflows/pages.yml`) build කරලා deploy කරයි.

---

## Vercel Hosting (PHP)

මේ project එක **database එකක් නැතුව** static data files use කරනවා. Vercel එකේ host කරන්න පුළුවන්.

### පියවර

1. https://vercel.com හි account එකක් හදන්න
2. **Add New Project** → GitHub repo `Sanka43/mpda` import කරන්න
3. Framework Preset: **Other** (auto-detect වෙයි)
4. **Deploy** click කරන්න

`vercel.json` file එක PHP runtime (`vercel-php`) සහ routes automatically setup කරලා තියෙනවා.

### Custom domain

Vercel dashboard → Project → **Settings** → **Domains** → `mpdancingacademy.com` add කරන්න.

### Data update කරන්න

Content edit කරන්න `data/` folder එකේ files:

| File | Content |
|------|---------|
| `data/branches.php` | Branch locations & schedules |
| `data/events.php` | Events & concerts |
| `data/testimonials.php` | Parent feedback |
| `data/blog.php` | Blog posts |

Edit කරලා GitHub එකට push කළාම Vercel auto-deploy වෙයි.

### Forms

Registration, contact, සහ feedback forms WhatsApp එකට message එකක් send කරනවා (database save නොකරයි).

---

## Local development (XAMPP)

```
http://localhost/mpda/
```

- `config/local.php` නැත්නම් `BASE_URL` = `/mpda`
- Database අවශ්‍ය නැහ — `data/` folder එකෙන් content load වෙයි

---

## Project structure

| Path | Purpose |
|------|---------|
| `pages/` | Public pages |
| `api/` | Vercel entry point & form handlers |
| `data/` | Static content (branches, events, etc.) |
| `config/` | App configuration |
| `assets/images/` | Gallery & branding |
| `vercel.json` | Vercel deployment config |
