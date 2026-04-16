# Projecte Final Desplegament

Aplicació web Laravel amb Docker.

**Autors:** Derek Segura i Oriol Rodríguez 

---

## Requisits

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/)

---

## Instal·lació

```bash
git clone https://github.com/DerekSegura/projecte-final-desplegament.git
cd projecte-final-desplegament
git checkout dev
bash setup.sh
```

Un cop acabat, accedeix a: **http://localhost:8000**

---

## Què fa el setup.sh?

1. Neteja contenidors i volums antics
2. Construeix i aixeca els contenidors (PHP, Nginx, MySQL)
3. Instal·la les dependències PHP (composer)
4. Crea el fitxer `.env` i genera l'APP_KEY
5. Executa les migracions de la base de dades
6. Compila els assets CSS/JS (npm)
7. Arregla els permisos del storage

---

## Tecnologies

- Laravel 12
- PHP 8.3
- MySQL 8.0
- Nginx
- Docker