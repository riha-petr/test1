# Traveling App

This project contains a simple PHP-based web site. Before using the site, initialize the database.

```bash
php db-create.php
```

Running this script will create required tables (users and albums) and insert a default admin user. Once complete, delete `db-create.php` for security reasons.

## Managing Albums

After signing in as an admin, go to the **Albums** section in the admin panel to add new albums. Created albums are automatically displayed on `albums.php`.
