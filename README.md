# Trapping Water

## 🚀 Como Rodar a Aplicação

### **1. Subindo o Contêiner**

Para iniciar a aplicação, execute o seguinte comando:

```sh
docker-compose up -d
```

Isso irá subir o contêiner em segundo plano.

### **2. Executando o Script**

Para rodar o script principal (`exec.php`):

```sh
docker exec -it app-vsantos php exec.php
```

### **3. Rodando os Testes**

Para executar os testes unitários com PHPUnit:

```sh
docker exec -it app-vsantos vendor/bin/phpunit
```

---

## 📂 Estrutura do Projeto

```
├── README.md
├── app
│   ├── Dockerfile
│   ├── composer.json
│   ├── composer.lock
│   ├── exec.php
│   ├── phpunit.xml
│   ├── src
│   │   ├── TrapingRainWater.php
│   │   ├── case.txt
│   │   ├── poc.php
│   │   └── tests
│   │       └── TrapingRainWaterTest.php

```

---

## 🛠️ Tecnologias Utilizadas

- **PHP 8.3**
- **Docker**
- **PHPUnit**

---

