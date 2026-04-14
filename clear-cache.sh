#!/bin/bash
# Clear all caches dan restart aplikasi
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo "✅ Cache cleared - refresh browser dengan Ctrl+Shift+Del"
