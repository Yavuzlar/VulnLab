<!-- PROJECT LOGO -->
<p align="center">
  <a href="https://siberyavuzlar.com">
    <img src="https://i.ibb.co/nDLHW7m/logomodern.png" alt="Logo" width="180" height="180">
  </a>

  <h3 align="center">VulnLab</h3> 

  <p align="center">
    A web vulnerability lab project developed by Yavuzlar.
  </p>
</p>

<a href="https://s10.gifyu.com/images/Animation387bbf064343cb3fe.gif">
    <img src="https://s10.gifyu.com/images/Animation387bbf064343cb3fe.gif" alt="Logo"  >
</a>

<!-- Vulnerabilities -->
## Vulnerabilities

* SQL Injection
* Cross Site Scripting (XSS)
* Command Injection
* Insecure Direct Object References (IDOR)
* Cross Site Request Fxxorgery (CSRF)
* XML External Entity (XXE)
* Insecure Deserialization
* File Upload
* File Inclusion
* Broken Authentication

<!-- Installation -->
## Installation

### Install with DockerHub

1. If you want to install on DockerHub, just type this command.
   ```sh
    docker run --name vulnlab -d -p 1337:80 yavuzlar/vulnlab:latest
   ```
2. Go to http://localhost:1337

### Manuel Installation

1. Clone the repo
   ```sh
    git clone https://github.com/Yavuzlar/VulnLab
   ```
2. Build docker image
   ```sh
    docker build -t yavuzlar/vulnlab .
   ```
3. Run container
   ```sh
    docker run -d -p 1337:80 yavuzlar/vulnlab
   ```
4. Go to http://localhost:1337

### Google Cloud

[![Run on Google Cloud](https://deploy.cloud.run/button.svg)](https://deploy.cloud.run/?git_repo=https://github.com/Yavuzlar/VulnLab)

<!-- SPONSOR -->

## Sponsor

<a href="https://cyrops.com/">
    <img src="https://cyrops.com/img/logo.png" alt="Logo" width="200" >
</a>

<!-- CONTACT -->
## Contact

[Web Site](https://siberyavuzlar.com/) </br>
[Linkedln](https://www.linkedin.com/company/siberyavuzlar) <br>
[Twitter](https://twitter.com/siberyavuzlar) </br>
[Instagram](https://www.instagram.com/siberyavuzlar/)
