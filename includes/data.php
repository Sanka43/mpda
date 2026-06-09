<?php

function loadDataFile(string $file): array
{
    $path = __DIR__ . '/../data/' . $file . '.php';
    if (!file_exists($path)) {
        return [];
    }

    return require $path;
}

function getBranches(): array
{
    $branches = loadDataFile('branches');
    $active = array_filter($branches, fn($b) => !empty($b['is_active']));

    usort($active, fn($a, $b) => ($a['sort_order'] ?? 0) <=> ($b['sort_order'] ?? 0));

    return array_values($active);
}

function getBranchById(int $id): ?array
{
    foreach (getBranches() as $branch) {
        if ((int)$branch['id'] === $id) {
            return $branch;
        }
    }

    return null;
}

function getFeaturedEvent(): ?array
{
    foreach (loadDataFile('events') as $event) {
        if (!empty($event['is_active']) && !empty($event['is_featured'])) {
            return $event;
        }
    }

    return null;
}

function getEvents(): array
{
    $events = array_filter(loadDataFile('events'), fn($e) => !empty($e['is_active']));

    usort($events, fn($a, $b) => strcmp($a['event_date'] ?? '', $b['event_date'] ?? ''));

    return array_values($events);
}

function getTestimonials(int $limit = 10): array
{
    $items = array_filter(loadDataFile('testimonials'), fn($t) => !empty($t['is_approved']));

    usort($items, fn($a, $b) => strcmp($b['created_at'] ?? '', $a['created_at'] ?? ''));

    return array_slice(array_values($items), 0, $limit);
}

function getBlogPosts(int $limit = 10): array
{
    $posts = array_filter(loadDataFile('blog'), fn($p) => !empty($p['is_published']));

    usort($posts, fn($a, $b) => strcmp($b['published_at'] ?? '', $a['published_at'] ?? ''));

    return array_slice(array_values($posts), 0, $limit);
}

function formatBranchTime(string $start, string $end): string
{
    return date('g:i A', strtotime($start)) . ' – ' . date('g:i A', strtotime($end));
}

function eventTitle(array $event): string
{
    return currentLang() === 'si' ? ($event['title_si'] ?: $event['title_en']) : $event['title_en'];
}

function eventDescription(array $event): string
{
    return currentLang() === 'si' ? ($event['description_si'] ?: $event['description_en']) : ($event['description_en'] ?? '');
}

function testimonialContent(array $item): string
{
    return currentLang() === 'si' ? ($item['content_si'] ?: $item['content_en']) : $item['content_en'];
}

function blogTitle(array $post): string
{
    return currentLang() === 'si' ? ($post['title_si'] ?: $post['title_en']) : $post['title_en'];
}

function blogExcerpt(array $post): string
{
    return currentLang() === 'si' ? ($post['excerpt_si'] ?: $post['excerpt_en']) : ($post['excerpt_en'] ?? '');
}
