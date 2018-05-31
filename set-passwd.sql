use hosts;
UPDATE sys_user SET passwort = md5('PASSWORD') WHERE username = 'ping';
FLUSH PRIVILEGES;
