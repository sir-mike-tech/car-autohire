<?php require_once('Connections/drive.php'); ?>
<?php
// Start session in a compatibility-safe way
if (function_exists('session_status')) {
  if (session_status() !== PHP_SESSION_ACTIVE) session_start();
} else {
  if (session_id() == '') session_start();
}

// *** Validate request to login to this site.
$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['email'])) {
  $loginUsername = trim($_POST['email']);
  $password = trim($_POST['password']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "booking.html";
  $MM_redirectLoginFailed = "index.php";
  $MM_redirecttoReferrer = false;

  // Choose the correct DB connection variables (support both "drive" and "pop" naming)
  $dbConn = null;
  $dbName = null;
  if (isset($drive) && $drive) { $dbConn = $drive; $dbName = isset($database_drive) ? $database_drive : null; }
  elseif (isset($pop) && $pop) { $dbConn = $pop; $dbName = isset($database_pop) ? $database_pop : null; }

  if (!$dbConn || !function_exists('mysql_query')) {
    // Database connection not available or mysql extension missing
    header("Location: " . $MM_redirectLoginFailed . "?error=db");
    exit;
  }

  // Select database if possible
  if ($dbName) mysql_select_db($dbName, $dbConn);

  // Safe escaping (use mysql_real_escape_string when possible)
  if (function_exists('mysql_real_escape_string')) {
    $u = mysql_real_escape_string($loginUsername, $dbConn);
    $p = mysql_real_escape_string($password, $dbConn);
  } else {
    $u = get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername);
    $p = get_magic_quotes_gpc() ? $password : addslashes($password);
  }

  $LoginRS__query = sprintf(
    "SELECT email, password FROM register WHERE email='%s' AND password='%s'",
    $u, $p
  );

  $LoginRS = @mysql_query($LoginRS__query, $dbConn) or die(mysql_error());
  $loginFoundUser = $LoginRS ? mysql_num_rows($LoginRS) : 0;

  if ($loginFoundUser) {
     $loginStrGroup = "";

    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
    exit;
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
    exit;
  }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login — Sir Mike AutoHire</title>
  <meta name="description" content="Login to Sir Mike AutoHire — access bookings and account details." />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --accent:#0b7dfa; --accent-600:#0767c9; --bg-1:#eef6ff; --bg-2:#f7fbff;
      --card:rgba(255,255,255,0.96); --muted:#6b7280; --dark:#0f1724;
      --radius:14px; --shadow-lg:0 20px 50px rgba(12,18,30,0.10); --glass-border:rgba(11,125,250,0.06);
      --maxw:980px; font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;color:var(--dark);-webkit-font-smoothing:antialiased}
    body{background:linear-gradient(180deg,var(--bg-1),var(--bg-2));font-size:15px;line-height:1.45}
    .container{max-width:var(--maxw);margin:30px auto;padding:20px}
    .card{display:flex;gap:28px;align-items:stretch;background:linear-gradient(180deg,var(--card),rgba(255,255,255,0.86));border-radius:var(--radius);padding:22px;box-shadow:var(--shadow-lg);border:1px solid var(--glass-border);transition:transform .18s ease}
    .card:hover{transform:translateY(-6px);box-shadow:0 28px 70px rgba(12,18,30,0.12)}
    .col{flex:1;min-width:0}
    aside{width:340px;flex-shrink:0}
    @media(max-width:860px){.card{flex-direction:column}aside{width:100%}}
    h1{margin:0 0 8px;font-size:22px}
    p.lead{margin:0 0 14px;color:var(--muted);font-size:14px}
    form{max-width:520px}
    .field{display:flex;flex-direction:column;margin-bottom:12px}
    label{font-size:13px;color:var(--muted);margin-bottom:8px}
    input[type="email"],input[type="password"]{padding:12px 14px;border-radius:10px;border:1px solid #e6eef9;background:linear-gradient(180deg,#fff,#fbfdff);font-size:15px;color:var(--dark);outline:none;transition:box-shadow .14s ease,border-color .14s ease,transform .12s ease}
    input::placeholder{color:#9aa6b9}
    input:focus{border-color:var(--accent);box-shadow:0 6px 24px rgba(11,125,250,0.08);transform:translateY(-1px)}
    .controls{display:flex;align-items:center;gap:8px;justify-content:space-between}
    .btn{background:linear-gradient(90deg,var(--accent),var(--accent-600));color:#fff;padding:10px 14px;border-radius:10px;border:0;font-weight:700;cursor:pointer;box-shadow:0 10px 30px rgba(11,125,250,0.12)}
    .btn:hover{transform:translateY(-2px)}
    .ghost{background:transparent;border:1px solid rgba(11,125,250,0.08);padding:9px 12px;border-radius:10px;cursor:pointer}
    .muted{color:var(--muted)}
    .error{color:#b00020;font-size:13px;display:none;margin-top:8px}
    .note{font-size:13px;color:var(--muted);margin-top:8px}
    .helper-links{margin-top:10px;display:flex;gap:8px;flex-wrap:wrap}
    .helper-links a{color:var(--accent-600);text-decoration:none;font-weight:600}
    @media(max-width:520px){.container{padding:14px}.card{padding:16px;gap:16px}aside{width:100%}}
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
        <a class="ghost" href="index.php">Register</a>
      </div>
    </div>

    <div class="card" role="region" aria-labelledby="loginTitle">
      <div class="col" style="max-width:560px">
        <h1 id="loginTitle">Welcome back</h1>
        <p class="lead">Log in to view bookings, manage your profile and access exclusive offers.</p>

        <form ACTION="<?php echo $loginFormAction; ?>" METHOD="POST" id="loginForm" novalidate>
          <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="you@example.com" required>
          </div>

          <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password" placeholder="••••••••" required>
          </div>

          <div style="display:flex;align-items:center;gap:12px;justify-content:space-between;margin-bottom:6px">
            <label style="font-size:13px;color:var(--muted);display:inline-flex;align-items:center;gap:8px">
              <input id="remember" type="checkbox" /> Remember me
            </label>
            <a class="muted" href="contact.html">Forgot password?</a>
          </div>

          <div class="error" id="loginError" role="alert"></div>

          <div style="display:flex;gap:10px;margin-top:8px">
            <button class="btn" type="submit">Sign in</button>
            <a class="ghost" href="booking.html">Book as guest</a>
          </div>

          <div class="note">Need an account? <a href="index.php" style="color:var(--accent-600);text-decoration:none">Create one</a> or <a href="contact.html" style="color:var(--accent-600)">contact support</a>.</div>
        </form>
      </div>

     
    </div>
  </div>

  <script>
    (function(){
      const form = document.getElementById('loginForm');
      const err = document.getElementById('loginError');

      function showError(msg){
        err.textContent = msg;
        err.style.display = 'block';
      }

      form.addEventListener('submit', function(e){
        e.preventDefault();
        err.style.display = 'none';
        const email = document.getElementById('email').value.trim().toLowerCase();
        const pass = document.getElementById('password').value;
        const remember = document.getElementById('remember').checked;

        if(!email || !pass){ showError('Please enter email and password.'); return; }

      
    })();
  </script>
</body>
</html>
