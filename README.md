<h1>Simple Demo ticketing system for a record history of feedback lists or bugs from client</h1>
<h3>How to use</h3>
<h4>For Other Setup</h4>
<ul>
    <li>Clone the repository with <b>git clone</b></li>
    <li>Copy <b>.env.example</b> file to <b>.env</b> and edit database credentials there</li>
    <li>Run <b>composer install</b></li>
    <li>Run <b>php artisan key:generate</b></li>
    <li>Run <b>php artisan migrate --seed</b> (it has some seeded data for your testing)</li>
    <li>That's it: launch the main URL.</li>
    <li>You can login as admin to manage data with default credentials <b>admin@gmail.com - admin123</b></li>
</ul>
<h4>For Docker Setup</h4>
I assume you have installed Docker and Docker Compose.

<ul>
    <li>Clone the repository with <b>git clone</b></li>
    <li>Copy <b>.env.example</b> file to <b>.env</b> and edit database credentials there</li>
    <li>Run <b>docker compose build app</b></li>
    <li>Run <b>docker compose up -d</b></li>
    <li>Run <b>docker compose exec app rm -rf vendor composer.lock</b></li>
    <li>Run <b>docker compose exec app composer install</b></li>
    <li>Run <b>docker compose exec app php artisan key:generate</b></li>
    <li>Run <b>docker compose exec app php artisan migrate --seed</b> (it has some seeded data for your testing)</li>
    <li>That's it: launch the main URL.</li>
    <li>You can login as admin to manage data with default credentials <b>admin@gmail.com - admin123</b></li>
</ul>


