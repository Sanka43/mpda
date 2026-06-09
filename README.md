# MPDA Website

Menaka Peiris Dancing Academy — PHP website with admin panel, registrations, blog, and gallery.

## GitHub හරහා host කරන්න පුළුවන්ද?

**GitHub Pages** static files (HTML/CSS/JS) පමණයි host කරයි. මේ site එක **PHP + MySQL** නිසා GitHub Pages මත **සෘජුව run වෙන්නේ නැහ**.

**විසඳුම:** Code එක GitHub එකේ තියාගෙන, **PHP hosting** එකකට deploy කරන්න (InfinityFree, 000webhost, හෝ paid host).

Repository: https://github.com/Sanka43/mpda

---

## Free hosting — InfinityFree (ඉක්මන් පියවර)

1. https://infinityfree.com හි account එකක් හදන්න
2. **Create Account** → subdomain හෝ `mpdancingacademy.com` domain connect කරන්න
3. Control Panel → **MySQL Databases** → database එක create කරන්න (host, name, user, password copy කරගන්න)
4. **Online File Manager** හෝ FTP client එකෙන් files upload කරන්න (GitHub repo එක download කරලා හෝ FTP auto-deploy use කරලා)
5. Server එකේ `config/local.example.php` copy කරලා `config/local.php` කරන්න — database details + `base_url` = `''` (domain root)
6. `.htaccess.production` එකේ content copy කරලා `.htaccess` replace කරන්න (RewriteBase `/`)
7. Browser එකෙන් `https://yoursite.com/install.php` open කරලා database install කරන්න
8. Install ඉවර වුණාම `install.php` delete කරන්න

**Admin:** `https://yoursite.com/admin/login.php`  
Default login: `config/app.php` එකේ තියෙන credentials (production එකේ password change කරන්න).

---

## GitHub Actions — auto deploy (FTP)

Push කරනකොට automatic upload කරන්න:

1. GitHub repo → **Settings** → **Secrets and variables** → **Actions**
2. Secrets add කරන්න:
   - `FTP_SERVER` — e.g. `ftpupload.net`
   - `FTP_USERNAME`
   - `FTP_PASSWORD`
   - `FTP_SERVER_DIR` — e.g. `/htdocs/` (host අනුව වෙනස් වෙයි)
3. Server එකේ **එක් වරක්** `config/local.php` manually create කරන්න (secrets එකට commit නොකරන්න)
4. `main` branch එකට push කළාම `.github/workflows/deploy-ftp.yml` run වෙයි

---

## Local development (XAMPP)

```
http://localhost/mpda/
```

- Database: `config/database.php` defaults (`localhost`, `root`, empty password)
- `config/local.php` නැත්නම් `BASE_URL` = `/mpda` (default)

---

## Project structure

| Path | Purpose |
|------|---------|
| `pages/` | Public pages |
| `admin/` | Admin panel |
| `api/` | Form submissions |
| `config/` | App & database config |
| `database/schema.sql` | DB schema |
| `assets/images/` | Gallery & branding |
