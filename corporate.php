<?php require_once('Connections/corporatesite.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO corporate (org, contact, email, phone, details) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['organization'], "text"),
                       GetSQLValueString($_POST['contact_name'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['phone'], "int"),
                       GetSQLValueString($_POST['details'], "text"));

  mysql_select_db($database_corporatesite, $corporatesite);
  $Result1 = mysql_query($insertSQL, $corporatesite) or die(mysql_error());

  $insertGoTo = "cars.html";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Corporate & Fleet Solutions — Sir Mike AutoHire</title>
  <meta name="description" content="Tailored fleet and corporate rental solutions from Sir Mike AutoHire — dedicated account management, flexible billing and priority support." />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles.css">
  <style>
    :root{
      --accent: #0b7dfa;
      --accent-600: #0966c9;
      --accent-700: #054ea8;
      --dark: #0f1724;
      --muted: #6b7280;
      --bg: #f6f8fb;
      --card: #ffffff;
      --glass: rgba(255,255,255,0.6);
      --radius: 14px;
      --container: 1100px;
      --shadow-sm: 0 8px 24px rgba(16,36,58,0.06);
      --shadow-lg: 0 22px 48px rgba(16,36,58,0.12);
      --glass-border: rgba(11,125,250,0.06);
      font-family: Inter, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }

    *{box-sizing:border-box}
    html,body{height:100%}
    body{
      margin:0;
      background:
        radial-gradient(800px 300px at 10% 10%, rgba(11,125,250,0.04), transparent 12%),
        linear-gradient(180deg,#f8fbff 0%, var(--bg) 55%);
      color:var(--dark);
      -webkit-font-smoothing:antialiased;
      -moz-osx-font-smoothing:grayscale;
      font-size:16px;
      line-height:1.5;
    }

    .container{
      max-width:var(--container);
      margin:28px auto;
      padding:22px;
    }

    /* Header */
    header.nav{
      display:flex;
      align-items:center;
      justify-content:space-between;
      gap:18px;
      padding:14px;
      background:linear-gradient(180deg, rgba(255,255,255,0.92), rgba(255,255,255,0.82));
      border-radius:12px;
      box-shadow:var(--shadow-sm);
      border:1px solid rgba(15,23,36,0.04);
      transform:translateY(0);
      animation: enterUp .6s ease both;
    }
    @keyframes enterUp { from { opacity:0; transform: translateY(10px); } to { opacity:1; transform: translateY(0); } }

    .brand{display:flex;gap:12px;align-items:center;font-weight:800;color:var(--dark)}
    .brand img{height:44px;border-radius:8px;object-fit:cover}
    nav{display:flex;gap:10px;align-items:center}
    nav a{
      color:var(--muted);
      text-decoration:none;
      padding:8px 10px;
      border-radius:10px;
      font-weight:600;
      transition:all .16s ease;
      position:relative;
    }
    nav a::after{
      content:'';
      position:absolute;
      left:10px; right:10px; bottom:6px;
      height:0; border-radius:6px; background:transparent; transition:all .18s ease;
    }
    nav a:hover{color:var(--accent-700); transform:translateY(-3px)}
    nav a:hover::after{height:6px; background:linear-gradient(90deg, rgba(11,125,250,0.06), rgba(9,102,201,0.04))}

    /* Hero / Layout */
    .hero{
      display:grid;
      grid-template-columns: 1fr 420px;
      gap:28px;
      align-items:start;
      margin-top:18px;
    }
    .hero h1{font-size:30px;margin:0 0 8px;color:#07243e;line-height:1.15}
    .hero p{margin:0;color:var(--muted);font-size:15px}
    .hero-intro{animation:fadeIn .7s ease .12s both}

    @keyframes fadeIn { from { opacity:0; transform:translateY(10px) } to { opacity:1; transform:none } }

    /* Card base */
    .card{
      background:var(--card);
      border-radius:var(--radius);
      padding:18px;
      box-shadow:var(--shadow-sm);
      border:1px solid rgba(15,23,36,0.04);
      transition:transform .18s ease, box-shadow .18s ease;
    }
    .card.raised:hover{ transform:translateY(-8px); box-shadow:var(--shadow-lg) }

    /* Benefits */
    .benefits{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:14px;
      margin-top:18px;
    }
    .benefit{
      background:linear-gradient(180deg, #fff, #fbfdff);
      border-radius:12px;
      padding:18px;
      text-align:center;
      transition:transform .22s cubic-bezier(.16,.84,.38,1), box-shadow .22s ease;
      transform-origin:center;
      opacity:0; transform:translateY(12px) scale(.98);
    }
    .benefit.in-view{ opacity:1; transform:translateY(0) scale(1); transition-delay:calc(var(--i) * 60ms) }
    .benefit:hover{ transform:translateY(-8px) scale(1.02); box-shadow:var(--shadow-lg) }
    .benefit .icon{font-size:30px; filter:drop-shadow(0 6px 18px rgba(11,125,250,0.06)) }
    .benefit h4{margin:10px 0 6px;color:#07243e}
    .benefit p{margin:0;color:var(--muted);font-size:14px}

    /* Packages */
    .packages{
      display:grid;
      grid-template-columns:repeat(3,1fr);
      gap:14px;
      margin-top:18px;
      align-items:start;
    }
    .pkg{
      border-radius:12px;
      padding:18px;
      background:linear-gradient(180deg,#fff,#fbfdff);
      box-shadow:0 10px 28px rgba(12,18,30,0.04);
      border:1px solid rgba(11,125,250,0.04);
      transition:transform .18s ease, box-shadow .18s ease;
      position:relative;
      overflow:visible;
      opacity:0; transform:translateY(12px);
    }
    .pkg.in-view{ opacity:1; transform:translateY(0); transition-delay:calc(var(--i) * 60ms) }
    .pkg:hover{ transform:translateY(-10px); box-shadow:var(--shadow-lg) }
    .pkg h3{margin:0 0 6px;color:#07243e}
    .pkg .price{font-weight:800;color:var(--accent);margin-top:10px;font-size:16px}
    .pkg ul{margin:8px 0 0;padding-left:18px;color:var(--muted)}
    .pkg .badge{
      position:absolute; right:16px; top:14px;
      background:linear-gradient(90deg,var(--accent),var(--accent-600));
      color:white;padding:6px 10px;border-radius:999px;font-weight:800;font-size:12px;box-shadow:0 8px 20px rgba(11,125,250,0.12)
    }

    /* Aside / Form */
    aside.card{
      position:sticky;
      top:28px;
      height:max-content;
      animation:fadeIn .6s ease .18s both;
    }
    .form-grid{
      display:grid;
      grid-template-columns:1fr 1fr;
      gap:10px;
    }
    .field{display:flex;flex-direction:column;gap:6px}
    label{font-weight:700;font-size:13px;color:#0b1f33}
    input,textarea,select{
      padding:10px;border-radius:10px;border:1px solid #e9f2ff;background:#fff;font-size:14px;
      outline:none;transition:box-shadow .12s ease, border-color .12s ease, transform .08s ease;
    }
    input:focus,textarea:focus,select:focus{box-shadow:0 12px 28px rgba(11,125,250,0.06);border-color:var(--accent-600);transform:translateY(-2px)}

    textarea{min-height:120px;resize:vertical}

    .cta{display:flex;gap:10px;margin-top:8px;justify-content:flex-end}
    .btn{
      background:linear-gradient(90deg,var(--accent),var(--accent-600));
      color:#fff;padding:10px 14px;border-radius:10px;border:0;font-weight:800;text-decoration:none;
      box-shadow:0 12px 30px rgba(11,125,250,0.12);
      cursor:pointer;
      transition:transform .12s ease, box-shadow .12s ease, filter .12s ease;
    }
    .btn:hover{transform:translateY(-4px) scale(1.02);box-shadow:0 24px 60px rgba(11,125,250,0.18); filter:brightness(1.02)}
    .ghost{
      background:transparent;border:1px solid rgba(11,125,250,0.08);padding:10px 12px;border-radius:10px;color:var(--dark);text-decoration:none;font-weight:700;
    }

    /* Floating accent graphic */
    .accent-blob{
      width:110px;height:110px;border-radius:22px;
      background:linear-gradient(135deg, rgba(11,125,250,0.12), rgba(9,102,201,0.06));
      position:relative; display:inline-block; margin-right:12px;
      transform:translateY(0); transition:transform .6s ease;
      animation: float 6s ease-in-out infinite;
    }
    @keyframes float { 0%{ transform:translateY(0)} 50%{ transform:translateY(-8px)} 100%{ transform:translateY(0)} }

    /* Utilities */
    .muted{color:var(--muted)}
    .price{font-size:18px;font-weight:800;color:var(--accent)}
    .small{font-size:13px;color:var(--muted)}

    footer{margin-top:24px;color:var(--muted);font-size:14px;padding-top:14px;border-top:1px solid rgba(12,18,30,0.04)}

    /* Responsive */
    @media (max-width:980px){
      .hero{grid-template-columns:1fr}
      .benefits,.packages{grid-template-columns:1fr}
      .form-grid{grid-template-columns:1fr}
      aside.card{position:relative;top:0}
    }

    /* WHY CHOOSE US — updated, professional layout */
    .why-choose{
      margin-top:18px;
      display:grid;
      grid-template-columns:1fr 320px;
      gap:16px;
      align-items:start;
    }
    .features{display:grid;grid-template-columns:repeat(2,1fr);gap:12px}
    .feature-item{
      background:linear-gradient(180deg,#fff,#fbfdff);
      padding:14px;border-radius:12px;box-shadow:var(--shadow-sm);
      display:flex;gap:12px;align-items:flex-start;
    }
    .fi-icon{width:48px;height:48;border-radius:10px;background:linear-gradient(135deg,rgba(11,125,250,0.08),#fff);display:flex;align-items:center;justify-content:center;font-size:20px}
    .feature-item h4{margin:0;font-size:15px;color:#07243e}
    .feature-item p{margin:6px 0 0;color:var(--muted);font-size:13px;line-height:1.35}

    .metrics-compact{display:flex;flex-direction:column;gap:10px}
    .metric-pill{background:#fff;padding:12px;border-radius:12px;box-shadow:var(--shadow-sm);display:flex;justify-content:space-between;align-items:center}
    .metric-pill .num{font-weight:900;color:var(--accent);font-size:18px}
    .metric-pill .label{color:var(--muted);font-size:13px}

    .why-cta{margin-top:12px;display:flex;flex-direction:column;gap:10px}
    .why-cta .btn{width:100%}
    .why-cta .ghost{width:100%;text-align:center}
  </style>
</head>
<body>
  <div class="container">
    <header class="nav card" role="banner" aria-label="Top header">
      <div class="brand">
        <div class="accent-blob" aria-hidden="true"></div>
        <div>
          <div style="font-weight:900;font-size:18px">Sir Mike AutoHire</div>
          <div style="color:var(--muted);font-size:13px;margin-top:2px">Corporate & Fleet Solutions</div>
        </div>
      </div>
      <nav aria-label="Main navigation">
        <a href="home.html">Home</a>
        <a href="cars.html">Cars</a>
        <a href="booking.html">Book</a>
        <a href="about.html">About</a>
        <a href="contact.html">Contact</a>      </nav>
    </header>

    <main>
      <section class="hero">
        <div>
          <div class="hero-intro">
            <h1>Flexible fleet programs for businesses</h1>
            <p>Dedicated account management, consolidated billing, priority vehicle allocation and custom contracts — designed to keep your people moving with minimal admin.</p>
          </div>

          <div class="benefits" aria-label="Benefits">
            <div class="benefit" style="--i:0" data-animate>
              <div class="icon">🤝</div>
              <h4>Account Manager</h4>
              <p class="muted">Single point of contact for bookings, billing and support.</p>
            </div>
            <div class="benefit" style="--i:1" data-animate>
              <div class="icon">📄</div>
              <h4>Flexible Invoicing</h4>
              <p class="muted">Monthly consolidated billing and custom reporting to suit your bookkeeping.</p>
            </div>
            <div class="benefit" style="--i:2" data-animate>
              <div class="icon">⏱️</div>
              <h4>Priority Support</h4>
              <p class="muted">24/7 roadside assistance and express vehicle replacement for corporate clients.</p>
            </div>
          </div>

          <div class="packages" aria-label="Corporate packages">
            <article class="pkg" style="--i:0" data-animate>
              <div class="badge">Popular</div>
              <h3>Starter</h3>
              <div class="muted">For small teams & occasional hires</div>
              <ul style="margin:8px 0 0;color:var(--muted)">
                <li>Volume discounts</li>
                <li>Flexible billing</li>
                <li>Priority on bookings</li>
              </ul>
              <div class="price">From KES 3,200/day</div>
              <div style="margin-top:10px"><a class="btn" href="contact.html">Request a quote</a></div>
            </article>

            <article class="pkg" style="--i:1" data-animate>
              <div class="badge" style="background:linear-gradient(90deg,#22c55e,#16a34a)">Best value</div>
              <h3>Business</h3>
              <div class="muted">Ideal for regular travel and mid-size fleets</div>
              <ul style="margin:8px 0 0;color:var(--muted)">
                <li>Dedicated account manager</li>
                <li>Consolidated invoicing</li>
                <li>Priority vehicle allocation</li>
              </ul>
              <div class="price">Custom pricing</div>
              <div style="margin-top:10px"><a class="btn" href="contact.html">Speak with sales</a></div>
            </article>

            <article class="pkg" style="--i:2" data-animate>
              <div class="badge">Enterprise</div>
              <h3>Enterprise</h3>
              <div class="muted">Large fleets & long-term contracts</div>
              <ul style="margin:8px 0 0;color:var(--muted)">
                <li>Service-level agreements</li>
                <li>On-site vehicle delivery & servicing</li>
                <li>Tailored fleet management tools</li>
              </ul>
              <div class="price">By proposal</div>
              <div style="margin-top:10px"><a class="btn" href="contact.html">Request proposal</a></div>
            </article>
          </div>
        </div>

        <aside class="card" style="height:min-content">
          <h3 style="margin-top:0">Get a corporate quote</h3>
          <form name="form1" id="corporateForm" action="<?php echo $editFormAction; ?>" method="POST" onSubmit="return submitCorporate(event)">
            <div class="form-grid">
              <div class="field">
                <label for="org">Organization</label>
                <input id="org" name="organization" required />
              </div>
              <div class="field">
                <label for="contact">Contact name</label>
                <input id="contact" name="contact_name" required />
              </div>
              <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" required />
              </div>
              <div class="field">
                <label for="phone">Phone</label>
                <input id="phone" name="phone" required />
              </div>
              <div class="field" style="grid-column:1/-1">
                <label for="details">Project details / requirements</label>
                <textarea id="details" name="details" placeholder="Fleet size, locations, preferred vehicles, contract length"></textarea>
              </div>
              <div style="grid-column:1/-1;display:flex;gap:8px;align-items:center;justify-content:flex-end">
                <button type="submit" class="btn">Request quote</button>
                <a class="ghost" href="booking.html">Make a booking</a>
              </div>
            </div>
            <input type="hidden" name="MM_insert" value="form1">
          </form>

          <div style="margin-top:12px;color:var(--muted);font-size:13px">
            Or contact our corporate desk: <strong id="phone-copy" style="cursor:pointer;user-select:none">0707 480 602</strong><br>
            Email: <a href="mailto:sirmike6072@gmail.com">sirmike6072@gmail.com</a>
          </div>
        </aside>
      </section>

      <section class="why-choose" aria-labelledby="why-heading">
        <div>
          <div class="card">
            <h3 id="why-heading" style="margin:0 0 8px">Why businesses choose us</h3>
            <p class="muted" style="margin:0 0 12px">We combine predictable pricing, fast operations and dedicated support so your team keeps moving — with minimal admin and measurable uptime.</p>

            <div class="features" aria-hidden="false">
              <div class="feature-item" data-animate>
                <div class="fi-icon" aria-hidden="true">💼</div>
                <div>
                  <h4>Predictable billing</h4>
                  <p>Consolidated monthly invoices, detailed usage reports and flexible payment terms for easier bookkeeping.</p>
                </div>
              </div>

              <div class="feature-item" data-animate>
                <div class="fi-icon" aria-hidden="true">⚙️</div>
                <div>
                  <h4>Priority servicing & uptime</h4>
                  <p>Express repairs and vehicle replacement — backed by uptime targets so your operations aren't interrupted.</p>
                </div>
              </div>

              <div class="feature-item" data-animate>
                <div class="fi-icon" aria-hidden="true">🤝</div>
                <div>
                  <h4>Dedicated account management</h4>
                  <p>Single point of contact for bookings, disputes and reporting — proactive account reviews and optimisation tips.</p>
                </div>
              </div>

              <div class="feature-item" data-animate>
                <div class="fi-icon" aria-hidden="true">📊</div>
                <div>
                  <h4>Scalable fleet & analytics</h4>
                  <p>Scale up or down quickly, with management dashboards and usage insights to control cost and utilization.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <aside>
          <div class="card">
            <div style="display:flex;align-items:center;gap:12px">
              <div style="flex:1">
                <div style="font-size:13px;color:var(--muted)">Partner impact</div>
                <div style="font-weight:900;font-size:22px;color:var(--accent);margin-top:6px">10k+ users</div>
              </div>
              <div style="text-align:right">
                <div style="color:var(--muted);font-size:13px">Avg. fleet uptime</div>
                <div style="font-weight:900;font-size:18px;color:#0b7dfa">98%</div>
              </div>
            </div>

            <div class="metrics-compact" style="margin-top:12px">
              <div class="metric-pill">
                <div>
                  <div class="num">78</div>
                  <div class="label">Partner locations</div>
                </div>
                <div style="color:var(--muted);font-size:13px">Nationwide</div>
              </div>
              <div class="metric-pill">
                <div>
                  <div class="num">12540</div>
                  <div class="label">Bookings supported</div>
                </div>
                <div style="color:var(--muted);font-size:13px">Last 12 months</div>
              </div>
            </div>

            <div class="why-cta">
              <a class="btn" href="contact.html?topic=corporate">Request a tailored proposal</a>
              <a class="ghost" href="contact.html">Speak to our corporate desk</a>
            </div>
          </div>
        </aside>
      </section>
    </main>

    <footer>
      <div style="display:flex;justify-content:space-between;gap:12px;align-items:flex-start;flex-wrap:wrap">
        <div>
          <strong>Sir Mike AutoHire</strong><br>
          <div style="color:var(--muted);margin-top:6px">Nairobi, Kenya • Phone: 0707 480 602</div>
        </div>
        <div style="text-align:right">
          <div style="font-weight:700">Quick links</div>
          <div style="margin-top:6px"><a href="home.html">Home</a> · <a href="cars.html">Cars</a> · <a href="contact.html">Contact</a></div>
        </div>
      </div>
      <div style="margin-top:12px;color:var(--muted);font-size:13px">© Sir Mike AutoHire — Corporate solutions</div>
    </footer>
  </div>

  <script>
    // animate elements into view (staggered)
    (function(){
      const io = new IntersectionObserver((entries)=>{
        entries.forEach(en=>{
          if(en.isIntersecting){
            en.target.classList.add('in-view');
            io.unobserve(en.target);
          }
        });
      }, { threshold: 0.12 });

      document.querySelectorAll('[data-animate]').forEach(el => io.observe(el));

      // phone copy to clipboard with quick feedback
      const phone = document.getElementById('phone-copy');
      if(phone){
        phone.addEventListener('click', () => {
          const txt = phone.textContent.trim();
          if(navigator.clipboard){
            navigator.clipboard.writeText(txt).then(()=> alert('Phone number copied to clipboard'));
          } else {
            const ta = document.createElement('textarea'); ta.value = txt; document.body.appendChild(ta); ta.select();
            try{ document.execCommand('copy'); alert('Phone number copied to clipboard'); }catch(e){}
            ta.remove();
          }
        });
      }
    })();

    // form submit/demo persistence
    function submitCorporate(e){
      e.preventDefault();
      const org = document.getElementById('org').value.trim();
      const contact = document.getElementById('contact').value.trim();
      const email = document.getElementById('email').value.trim();
      if(!org || !contact || !email){ alert('Please complete required fields'); return false; }
      try{
        const k='corporate_enquiries';
        const arr = JSON.parse(localStorage.getItem(k)||'[]');
        arr.unshift({organization:org,contact, email, phone:document.getElementById('phone').value.trim(), details:document.getElementById('details').value.trim(), date:new Date().toISOString()});
        localStorage.setItem(k, JSON.stringify(arr));
      }catch(_){}
      alert('Thanks — your enquiry has been submitted. Our corporate team will contact you shortly (demo).');
      window.location.href = 'contact.html';
      return false;
    }
  </script>
</body>
</html>