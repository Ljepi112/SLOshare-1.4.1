## 📝 Kazalo

1. [Namestitev](#namestitev)
1.1. [Samodejni namestitveni program](#samodejni-namestitveni-program)
2. [Posodabljanje](#posodabljanje)
3. [Posebnosti posodobitev](#posebnosti-posodobitev)
4. [Brisanje polnilnika](#brisanje-polnilnika)
5. [Za obnovitev SSL potrdila](#obnovitev-ssl-potrdila)

## <a name="namestitev"></a> 🖥️ Namestitev
```
OPOMBA: Če uporabljate SLODovInnovations na primerku, ki ni HTTPS, MORATE spremeniti naslednje konfiguracije.

.env  <-- SESSION_SECURE_COOKIE mora biti nastavljen na false
config/secure-headers.php   <-- HTTP Strict Transport Security mora biti nastavljen na false
config/secure-headers.php   <-- Politika varnosti vsebine mora biti onemogočena 
```

### <a name="samodejni-namestitveni-program"></a> Samodejni namestitveni program
**SLOYakuza je izdal namestitveni program SLOshare Installer.**

**Uradno podprti OS**

    Ubuntu 20.04 LTS (priporočeno)
    Ubuntu 18.04 LTS
    Ubuntu 16.04 LTS

**Za Ubuntu 20.04 LTS:**
```
git clone https://github.com/SLODovInnovations/SLOshare-INSTALLER.git installer
cd installer
sudo ./install.sh
```

**Za Ubuntu 16.04 LTS ali Ubuntu 18.04 LTS:**
```
git clone https://github.com/SLODovInnovations/SLOshare-INSTALLER.git installer
cd installer
git checkout Ubuntu-16.04-18.04
sudo ./install.sh
```

## <a name="posodabljanje"></a> 🖥️ Posodabljanje
```
php artisan git:update
```
## <a name="posebnosti-posodobitev"></a> 🚨 Posebnosti posodobitev
V1.x.x -> V1.3.x
```
composer dump-autoload -o
```
v1.3.x -> V1.4.x
```
 php artisan migrate && sudo rm -rf node_modules && sudo npm cache clean --force && sudo npm install && sudo npx mix -p && php artisan optimize:clear && composer self-update && composer install && composer dump-autoload -o && php artisan optimize && sudo chown -R www-data: storage bootstrap public config && sudo find . -type d -exec chmod 0775 '{}' + -or -type f -exec chmod 0644 '{}' + && php artisan queue:restart && sudo supervisorctl reread && sudo supervisorctl update && sudo supervisorctl reload && sudo systemctl restart php8.1-fpm
```
## <a name="brisanje-polnilnika"></a> ✍️ Brisanje polnilnika
```
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache
php artisan event:clear
php artisan event:cache
php artisan cache:clear
php artisan optimize:clear
```
## <a name="obnovitev-ssl-potrdila"></a> 🔐 Za obnovitev SSL potrdila
**Za obnovitev SSL potrdila LetsEncrypt:**
```
certbot renew --dry-run
```
