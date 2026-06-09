<?php

function getBranches(PDO $db): array
{
    try {
        $stmt = $db->query('SELECT * FROM branches WHERE is_active = 1 ORDER BY sort_order ASC');
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

function getFeaturedEvent(PDO $db): ?array
{
    try {
        $stmt = $db->query('SELECT * FROM events WHERE is_active = 1 AND is_featured = 1 ORDER BY event_date ASC LIMIT 1');
        $event = $stmt->fetch();
        return $event ?: null;
    } catch (Exception $e) {
        return null;
    }
}

function getEvents(PDO $db): array
{
    try {
        $stmt = $db->query('SELECT * FROM events WHERE is_active = 1 ORDER BY event_date ASC');
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

function getTestimonials(PDO $db, int $limit = 10): array
{
    try {
        $stmt = $db->prepare('SELECT * FROM testimonials WHERE is_approved = 1 ORDER BY created_at DESC LIMIT ?');
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
}

function getBlogPosts(PDO $db, int $limit = 10): array
{
    try {
        $stmt = $db->prepare('SELECT * FROM blog_posts WHERE is_published = 1 ORDER BY published_at DESC LIMIT ?');
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return [];
    }
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
