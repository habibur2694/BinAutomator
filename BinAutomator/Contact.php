<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    header {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 1rem;
    }
    nav {
      background-color: #444;
      overflow: hidden;
    }
    nav a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }
    nav a:hover {
      background-color: #ddd;
      color: black;
    }
    .contact-section {
      padding: 2rem;
      text-align: center;
    }
    .contact-form {
      max-width: 400px;
      margin: 0 auto;
    }
    .contact-form input,
    .contact-form textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .contact-form button {
      background-color: #333;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 4px;
      cursor: pointer;
    }
    .contact-form button:hover {
      background-color: #555;
    }
  </style>
</head>
<body>
  <header>
    <h1>Contact Us</h1>
    <p>Get in touch with our team</p>
  </header>
  <nav>
    <a href="BinAutomator.php">Home</a>
    <a href="About.php">About</a>
    <a href="Serviecs.php">Services</a>
    <a href="Contact.php">Contact</a>
  </nav>
  <div class="contact-section">
    <div class="contact-form">
      <h2>Send us a Message</h2>
      <form>
        <input type="text" placeholder="Your Name" required>
        <input type="email" placeholder="Your Email" required>
        <textarea placeholder="Your Message" rows="6" required></textarea>
        <button type="submit">Send</button>
      </form>
    </div>
  </div>
</body>
</html>
