<?php require_once('Connections/drive.php'); ?>
<?php
// Ensure a session is started in a way that works on older PHP versions
if (function_exists('session_status')) {
  if (session_status() !== PHP_SESSION_ACTIVE) session_start();
} else {
  if (session_id() == '') session_start();
}
?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO register (fullname, phone, email, password, confirmpassword) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['fullname'], "text"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['password'], "text"));

  mysql_select_db($database_drive, $drive);
  $Result1 = mysql_query($insertSQL, $drive) or die(mysql_error());

  // redirect user after successful registration
  // choose destination: "home.html", "booking.html" or "confirmation.html"
  $insertGoTo = "home.html";

  // Optional: auto-login new user (start session if not started)
  if (function_exists('session_status')) {
    if (session_status() !== PHP_SESSION_ACTIVE) session_start();
  } else {
    if (session_id() == '') session_start();
  }
  $_SESSION['MM_Username'] = $_POST['fullname'];

  header("Location: " . $insertGoTo);
  exit;
}
?>
<?php
// *** Validate request to login to this site. (session already started above)

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['fullname'])) {
  $loginUsername=$_POST['fullname'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "home.html";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_drive, $drive);
  
  $LoginRS__query=sprintf("SELECT fullname, password FROM register WHERE fullname='%s' AND password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $drive) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Register — Sir Mike AutoHire</title>
    <meta name="description" content="Create an account to manage bookings and profile — Sir Mike AutoHire." />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/styles.css">
    <style>
    :root{
      --accent: #0b7dfa;
      --accent-600: #0767c9;
      --bg-1: #eef6ff;
      --bg-2: #f7fbff;
      --card: rgba(255,255,255,0.96);
      --muted: #6b7280;
      --dark: #0f1724;
      --radius: 14px;
      --shadow-lg: 0 20px 50px rgba(12,18,30,0.10);
      --shadow-sm: 0 8px 20px rgba(12,18,30,0.06);
      --glass-border: rgba(11,125,250,0.06);
      --maxw: 980px;
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
    }

    /* Reset */
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;color:var(--dark);-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
    body{
      background: linear-gradient(180deg, var(--bg-1), var(--bg-2));
      font-size:15px;
      line-height:1.45;
      -webkit-font-smoothing:antialiased;
    }

    .container{max-width:var(--maxw);margin:30px auto;padding:20px}

    /* Card / layout */
    .card{
      display:flex;
      gap:28px;
      align-items:stretch;
      background: linear-gradient(180deg, var(--card), rgba(255,255,255,0.86));
      border-radius:var(--radius);
      padding:22px;
      box-shadow:var(--shadow-lg);
      border:1px solid var(--glass-border);
      overflow:hidden;
      transition:transform .18s ease, box-shadow .18s ease;
    }
    .card:hover{ transform:translateY(-6px); box-shadow:0 28px 70px rgba(12,18,30,0.12) }

    .col{flex:1;min-width:0}
    aside{width:340px;flex-shrink:0}
    /* Improved breakpoint behavior: stack earlier on medium screens */
    @media(max-width:980px){
      .card{flex-direction:column;gap:18px}
      aside{width:100%}
    }

    /* Headings & text */
    h1{margin:0 0 8px;font-size:22px;letter-spacing:-0.2px}
    p.lead{margin:0 0 14px;color:var(--muted);font-size:14px}

    /* Form */
    form{max-width:560px;width:100%}
    .field{display:flex;flex-direction:column;margin-bottom:12px}
    label{font-size:13px;color:var(--muted);margin-bottom:8px}
    input[type="text"], input[type="email"], input[type="tel"], input[type="password"]{
      padding:12px 14px;border-radius:10px;border:1px solid #e6eef9;background:linear-gradient(180deg,#fff,#fbfdff);
      transition:box-shadow .14s ease, border-color .14s ease, transform .12s ease;
      font-size:15px;color:var(--dark);
      outline:none;
      box-shadow:none;
    }
    input::placeholder{color:#9aa6b9}
    input:focus{
      border-color:var(--accent);
      box-shadow:0 6px 24px rgba(11,125,250,0.08);
      transform:translateY(-1px);
    }

    /* Row layout for small fields */
    .fields-row{display:flex;gap:12px}
    .fields-row .field{flex:1}
    @media(max-width:640px){ .fields-row{flex-direction:column} }

    /* Buttons */
    .btn{
      background:linear-gradient(90deg,var(--accent),var(--accent-600));
      color:#fff;padding:10px 16px;border-radius:10px;border:0;font-weight:700;cursor:pointer;
      box-shadow:0 10px 30px rgba(11,125,250,0.12);
      transition:transform .12s ease, box-shadow .12s ease, opacity .12s ease;
    }
    .btn:hover{ transform:translateY(-2px); box-shadow:0 18px 44px rgba(11,125,250,0.14) }
    .ghost{
      background:transparent;border:1px solid rgba(11,125,250,0.12);padding:9px 12px;border-radius:10px;cursor:pointer;color:var(--accent-600);
    }

    /* Terms checkbox styling */
    label[for=""]{display:block}
    .checkbox-inline{display:inline-flex;align-items:center;gap:8px;color:var(--muted);font-size:13px}
    .checkbox-inline input{width:16px;height:16px}

    /* Error / success */
    .error{color:#b00020;font-size:13px;display:none;margin-top:8px}
    .success{color:#0b7a3a;font-size:13px;display:none;margin-top:8px}

    /* Aside */
    aside img{width:100%;height:190px;object-fit:cover;border-radius:10px;display:block}
    aside .panel{background:linear-gradient(180deg,#fff,#fbfdff);padding:12px;border-radius:10px;margin-top:12px;box-shadow:var(--shadow-sm);border:1px solid rgba(11,125,250,0.04)}
     .panel strong{display:block;margin-bottom:6px}

    /* Helper links */
    .helper-links{margin-top:10px;display:flex;gap:8px;flex-wrap:wrap}
    .helper-links a{color:var(--accent-600);text-decoration:none;font-weight:600;font-size:13px}

    /* Small improvements */
    .muted{color:var(--muted)}
    .hint{font-size:13px;color:#9aa6b9;margin-top:6px}
    .sr-only{position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0}

    /* Responsive tweaks */
    /* Small screens: stack and improve spacing, make CTAs full width */
    @media(max-width:640px){
      .container{padding:14px}
      .card{padding:16px;gap:14px;flex-direction:column}
      aside{width:100%}
      .btn, .ghost{width:100%}
      .card img{height:auto}
      form{width:100%}
    }

    /* Medium small screens: ensure form and aside spacing comfortable */
    @media(min-width:641px) and (max-width:979px){
      .container{padding:18px}
      .card{padding:18px}
      aside{width:100%}
      .btn{width:auto}
    }
    </style>
</head>
<body>
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/68ef972a1eb897194e018d9b/1j7jucvvs';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
  <div class="container">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px">
      <div style="display:flex;gap:14px;align-items:center">
        <img src="images/logo.png" alt="Sir Mike AutoHire" style="height:56px;border-radius:8px" onerror="this.style.display='none'">
        <div>
          <div style="font-weight:800">Sir Mike AutoHire</div>
          <div class="muted" style="font-size:13px">Drive Your Dream Today</div>
        </div>
      </div>
      <div>
        <a class="ghost" href="home.html">Home</a>
        <a class="ghost" href="login.php">Login</a>
      </div>
    </div>

    <div class="card" role="region" aria-labelledby="regTitle">
      <div class="col" style="max-width:560px">
        <h1 id="regTitle">Create an account</h1>
        <p class="lead">Register to manage bookings, save favourites and access member offers.</p>

        <form id="registerForm" action="<?php echo $loginFormAction; ?>" method="POST" name="form1" novalidate>
          <div class="field">
            <label for="fullname">Full name</label>
            <input id="fullname" name="fullname" type="text" placeholder="e.g. sir mike" required>
          </div>

          <div class="field">
            <label for="phone">Phone</label>
            <input id="phone" name="phone" type="tel" placeholder="+2547xxxxxxxx" required>
          </div>

          <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="you@example.com" required>
          </div>

          <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="At least 8 characters" required>
          </div>

          <div class="field">
            <label for="password2">Confirm password</label>
            <input id="password2" name="password2" type="password" placeholder="Repeat password" required>
          </div>

          <label style="display:inline-flex;align-items:center;gap:8px;font-size:13px;color:var(--muted)">
            <input id="terms" type="checkbox" /> I agree to the <a href="terms.html" style="color:var(--accent-600)">terms & conditions</a>
          </label>

          <div id="formError" class="error" role="alert"></div>
          <div id="formSuccess" class="success" role="status"></div>

          <div style="display:flex;gap:10px;margin-top:12px">
            <button class="btn" type="submit">Create account</button>
            <a class="ghost" href="login.php">Already registered?</a>
          </div>
        
            <input type="hidden" name="MM_insert" value="form1">
</form>
      </div>

      <aside style="width:320px">
        <img src="images/register-hero.jpg" alt="Ready to drive" style="width:100%;height:180px;object-fit:cover;border-radius:10px;margin-bottom:12px" onerror="this.src='https://via.placeholder.com/320x180?text=Register'">
        <div style="background:linear-gradient(180deg,#fff,#fbfdff);padding:12px;border-radius:10px;box-shadow:var(--shadow)">
          <div style="font-weight:700">Why register?</div>
          <ul style="margin:8px 0 0;color:var(--muted);padding-left:18px">
            <li>Manage bookings</li>
            <li>Save payment methods</li>
            <li>Access member offers</li>
          </ul>
        </div>
      </aside>
    </div>
  </div>

  <script>
    (function(){
      const form = document.getElementById('registerForm');
      const err = document.getElementById('formError');
      const success = document.getElementById('formSuccess');

      function validEmail(e){ return /\S+@\S+\.\S+/.test(e); }
      function validPhone(p){ return /^\+?\d{7,15}$/.test(p.replace(/\s+/g,'')); }
      function minStrong(p){ return p.length >= 8; }

      form.addEventListener('submit', function(e){
        e.preventDefault();
        err.style.display = 'none';
        success.style.display = 'none';

        const full = document.getElementById('fullname').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const email = document.getElementById('email').value.trim().toLowerCase();
        const pass = document.getElementById('password').value;
        const pass2 = document.getElementById('password2').value;
        const agreed = document.getElementById('terms').checked;

        if(!full || !phone || !email || !pass || !pass2){
          err.textContent = 'Please complete all required fields.';
          err.style.display = 'block';
          return;
        }
        if(!validPhone(phone)){ err.textContent = 'Please enter a valid phone number (include country code).'; err.style.display='block'; return; }
        if(!validEmail(email)){ err.textContent = 'Please enter a valid email address.'; err.style.display='block'; return; }
        if(!minStrong(pass)){ err.textContent = 'Password must be at least 8 characters.'; err.style.display='block'; return; }
        if(pass !== pass2){ err.textContent = 'Passwords do not match.'; err.style.display='block'; return; }
        if(!agreed){ err.textContent = 'You must agree to the terms to continue.'; err.style.display='block'; return; }

        // Optionally persist a demo copy to localStorage (DO NOT store real passwords in production)
        try{
          const demo = { fullname: full, phone: phone, email: email, created: Date.now() };
          localStorage.setItem('demo_new_user', JSON.stringify(demo));
        }catch(e){}

        // Submit form to server (will trigger PHP insert on the server)
        // Use form.submit() to bypass the submit handler and proceed with native submission
        form.submit();
      });
    })();
   </script>
</body>
</html>