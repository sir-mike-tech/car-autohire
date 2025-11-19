<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Partners — Sir Mike AutoHire</title>
  <meta name="description" content="Partnerships & suppliers — Sir Mike AutoHire works with trusted providers for insurance, maintenance, payments and logistics." />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --accent:#0b7dfa; --accent-600:#0767c9; --bg:#f6f8fb; --card:#ffffff; --muted:#6b7280; --dark:#0f1724;
      --radius:12px; --shadow: 0 18px 50px rgba(11,125,250,0.06); --maxw:1100px;
      font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,Arial,sans-serif;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;background:linear-gradient(180deg,var(--bg),#fff);color:var(--dark);-webkit-font-smoothing:antialiased}
    .container{max-width:var(--maxw);margin:28px auto;padding:0 18px}
    header{display:flex;align-items:center;justify-content:space-between;padding:12px 0}
    header .brand{display:flex;gap:12px;align-items:center;font-weight:700}
    header .brand img{height:44px;border-radius:8px}
    .hero{
      display:grid;grid-template-columns:1fr 420px;gap:22px;align-items:center;padding:22px;border-radius:14px;background:linear-gradient(180deg,#ffffff,#fbfdff);
      box-shadow:var(--shadow);border:1px solid rgba(11,125,250,0.04);
    }
    .hero-left h1{margin:0 0 8px;font-size:24px}
    .hero-left p{margin:0;color:var(--muted)}
    .hero-cta{margin-top:12px;display:flex;gap:10px}
    .btn{background:linear-gradient(90deg,var(--accent),var(--accent-600));color:#fff;padding:10px 14px;border-radius:10px;border:0;font-weight:700;cursor:pointer;text-decoration:none}
    .ghost{background:transparent;border:1px solid rgba(11,125,250,0.10);padding:9px 12px;border-radius:10px;color:var(--accent-600);text-decoration:none}
    .hero-right{position:relative;height:220px;border-radius:12px;overflow:hidden}
    .hero-right img{width:100%;height:100%;object-fit:cover;display:block;transform:scale(1.04);transition:transform .9s ease}
    .hero-right:hover img{transform:scale(1.0)}

    .partners-section{margin-top:22px;display:grid;grid-template-columns:2fr 1fr;gap:18px;align-items:start}
    @media(max-width:920px){ .hero{grid-template-columns:1fr} .partners-section{grid-template-columns:1fr} }

    .partners-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:12px}
    .partner-card{
      background:var(--card);padding:14px;border-radius:12px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;
      box-shadow:0 8px 30px rgba(12,18,30,0.04);transition:transform .18s ease,box-shadow .18s ease,filter .18s ease;
      border:1px solid rgba(11,125,250,0.03);
    }
    .partner-card img{height:48px;object-fit:contain;filter:grayscale(100%) contrast(.9);opacity:.85;transition:filter .18s ease,opacity .18s ease,transform .18s ease}
    .partner-card h4{margin:10px 0 6px;font-size:15px}
    .partner-card p{margin:0;color:var(--muted);font-size:13px}
    .partner-card:hover{transform:translateY(-8px);box-shadow:0 24px 60px rgba(11,125,250,0.08)}
    .partner-card:hover img{filter:none;opacity:1;transform:translateY(-4px)}

    .partners-right{background:linear-gradient(180deg,#fff,#fbfdff);padding:14px;border-radius:12px;box-shadow:var(--shadow);border:1px solid rgba(11,125,250,0.04)}
    .partners-right h3{margin:0 0 8px}
    .benefits{display:flex;flex-direction:column;gap:10px;margin-top:10px}
    .benefit{display:flex;gap:12px;align-items:flex-start}
    .icon{width:44px;height:44px;border-radius:10px;background:linear-gradient(180deg,#eef6ff,#fff);display:flex;align-items:center;justify-content:center;font-weight:800;color:var(--accent-600);box-shadow:0 8px 20px rgba(11,125,250,0.04)}
    .tiers{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-top:12px}
    .tier{background:#fff;padding:12px;border-radius:10px;border:1px solid rgba(12,18,30,0.03);box-shadow:0 8px 26px rgba(12,18,30,0.04)}
    .tier h4{margin:0 0 6px}

    /* CTA form */
    .partner-form{margin-top:12px;display:flex;flex-direction:column;gap:8px}
    .partner-form input,.partner-form textarea{padding:10px;border-radius:8px;border:1px solid #e6eef9}
    .partner-form button{align-self:flex-start}

    /* small animations */
    .fade-in-up{opacity:0;transform:translateY(8px);transition:opacity .6s ease,transform .6s ease}
    .in-view{opacity:1;transform:none}
    .logo-row{display:flex;gap:10px;flex-wrap:wrap;align-items:center;justify-content:center;margin-top:12px}
    .logo-row img{height:36px;filter:grayscale(100%);opacity:.9;border-radius:6px;padding:6px;background:#fff;border:1px solid rgba(11,125,250,0.03)}

    footer{margin-top:28px;padding:24px 0;color:var(--muted);text-align:center}

    /* partner impact, FAQ & carousel styles */
    .metrics{display:flex;gap:12px;margin-top:18px;flex-wrap:wrap}
    .metric{flex:1;min-width:140px;background:linear-gradient(180deg,#fff,#fbfdff);padding:14px;border-radius:10px;text-align:center;border:1px solid rgba(11,125,250,0.04);box-shadow:0 8px 30px rgba(12,18,30,0.03)}
    .metric .num{font-size:22px;font-weight:800;color:var(--accent);margin-bottom:6px}
    .case-studies{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:16px}
    .case{background:#fff;border-radius:10px;padding:12px;border:1px solid rgba(12,18,30,0.04);box-shadow:0 10px 30px rgba(12,18,30,0.04);display:flex;gap:10px;align-items:flex-start}
    .case img{width:110px;height:72px;object-fit:cover;border-radius:8px;flex-shrink:0}
    .faq{margin-top:18px}
    .accordion{border-radius:10px;overflow:hidden;border:1px solid rgba(12,18,30,0.04);background:#fff}
    .accordion button{width:100%;text-align:left;padding:12px 14px;border:0;background:transparent;display:flex;justify-content:space-between;align-items:center;font-weight:700;cursor:pointer}
    .accordion .panel{padding:0 14px 12px 14px;color:var(--muted);display:none}
    .download-row{display:flex;gap:10px;align-items:center;margin-top:14px}
    .download-row a{display:inline-flex;gap:8px;align-items:center}
    .logo-carousel{display:flex;gap:12px;overflow:hidden;padding:10px;border-radius:10px;background:linear-gradient(180deg,#ffffff,#fbfdff);border:1px solid rgba(11,125,250,0.04);margin-top:12px}
    .logo-track{display:flex;gap:18px;align-items:center;animation:scrollLogos 18s linear infinite}
    @keyframes scrollLogos{ 0%{transform:translateX(0)} 100%{transform:translateX(-50%)} }
    @media(max-width:920px){ .case-studies{grid-template-columns:repeat(2,1fr)} .metrics{flex-direction:row} }
    @media(max-width:560px){ .case-studies{grid-template-columns:1fr} .logo-track{animation-duration:24s} }
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
    <header>
      <div class="brand">
        <img src="images/m1.jpeg" alt="Sir Mike logo" onerror="this.style.display='none'">
        <div>
          <div>Sir Mike AutoHire</div>
          <small style="color:var(--muted)">Drive Your Dream Today</small>
        </div>
      </div>
      <nav aria-label="Primary">
        <a href="home.html" class="ghost">Home</a>
        <a href="cars.html" class="ghost">Cars</a>
        <a href="booking.html" class="btn">Book Now</a>
      </nav>
    </header>

    <section class="hero fade-in-up" id="hero">
      <div class="hero-left">
        <h1>Partnerships that deliver reliability</h1>
        <p>We partner with trusted insurance, maintenance, payment and logistics providers to keep our fleet road-ready and your experience seamless.</p>
        <div class="hero-cta">
          <a class="btn" href="contact.html">Contact partnerships</a>
          <a class="ghost" href="mailto:sirmike6072@gmail.com">Email us</a>
        </div>

        <div class="logo-row" aria-hidden="false" style="margin-top:14px">
          <img src="images/partner-insurance.svg" alt="Insurance partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Insurance'">
          <img src="images/partner-maintenance.svg" alt="Maintenance partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Maintenance'">
          <img src="images/partner-payments.svg" alt="Payments partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Payments'">
          <img src="images/partner-logistics.svg" alt="Logistics partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Logistics'">
        </div>
      </div>

      <div class="hero-right" aria-hidden="true">
        <img src="images/partner-cleaning.svg" alt="Partners collage" loading="lazy" onerror="this.src='https://via.placeholder.com/420x220?text=Partners'">
      </div>
    </section>

    <section class="partners-section" aria-labelledby="partnersHeading">
      <div>
        <h2 id="partnersHeading" style="margin:0 0 8px">Our core partners</h2>
        <p style="margin:0 0 12px;color:var(--muted)">Selected partners we rely on to offer coverage, maintenance, payments and logistics.</p>

        <div class="partners-grid" id="partnersGrid">
          <div class="partner-card fade-in-up">
            <img src="images/partner-insurance.svg" alt="Insurance partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Insurance'">
            <h4>CoverSure Insurance</h4>
            <p>Comprehensive motor cover and fast claims handling for our fleet.</p>
          </div>

          <div class="partner-card fade-in-up">
            <img src="images/partner-cleaning.svg" alt="Maintenance partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Maintenance'">
            <h4>AutoCare Garage</h4>
            <p>Certified servicing, pre-trip checks and priority repairs.</p>
          </div>

          <div class="partner-card fade-in-up">
            <img src="images/partner-logistics.svg" alt="Payments partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Payments'">
            <h4>SwiftPay</h4>
            <p>Secure card & mobile payment processing with timely payouts.</p>
          </div>

          <div class="partner-card fade-in-up">
            <img src="images/partner-logistics.svg" alt="Logistics partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Logistics'">
            <h4>FleetMove Logistics</h4>
            <p>Vehicle transport, delivery and airport handovers across Kenya.</p>
          </div>

          <div class="partner-card fade-in-up">
            <img src="images/partner-cleaning.svg" alt="Cleaning partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Cleaning'">
            <h4>EcoWash Services</h4>
            <p>Eco-friendly deep cleaning and sanitisation between rentals.</p>
          </div>

          <div class="partner-card fade-in-up">
            <img src="images/partner-tech.svg" alt="Technology partner" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Tech'">
            <h4>DriveTech</h4>
            <p>Telematics, booking integrations and performance analytics.</p>
          </div>
        </div>
      </div>

      <aside class="partners-right fade-in-up" aria-labelledby="benefitsHeading">
        <h3 id="benefitsHeading">Partner benefits</h3>
        <div class="benefits">
          <div class="benefit"><div class="icon">✓</div><div><strong>Reliable operations</strong><div class="muted">Fewer downtimes with scheduled maintenance.</div></div></div>
          <div class="benefit"><div class="icon">⚑</div><div><strong>Expanded reach</strong><div class="muted">Airport delivery & wider service coverage.</div></div></div>
          <div class="benefit"><div class="icon">⚡</div><div><strong>Fast payments</strong><div class="muted">Efficient settlement through our payments partner.</div></div></div>
        </div>

        <div class="tiers" role="list" aria-label="Partnership tiers">
          <div class="tier" role="listitem">
            <h4>Service Partner</h4>
            <div class="muted">Preferred rates for maintenance & cleaning.</div>
          </div>
          <div class="tier" role="listitem">
            <h4>Strategic Partner</h4>
            <div class="muted">Co-marketing and shared logistics support.</div>
          </div>
        </div>

        <form class="partner-form" id="partnerForm" aria-label="Partnership enquiry">
          <input id="pname" type="text" placeholder="Your name" required>
          <input id="porg" type="text" placeholder="Organization" required>
          <input id="pemail" type="email" placeholder="Email" required>
          <textarea id="pmsg" rows="4" placeholder="Brief message / proposal"></textarea>
          <button type="submit" class="btn">Send enquiry</button>
          <a class="ghost" href="mailto:sirmike6072@gmail.com" style="display:inline-block;margin-top:6px">Or email us directly</a>
        </form>
      </aside>
    </section>

    <!-- PARTNER IMPACT & CASE STUDIES -->
    <section aria-labelledby="impactHeading" style="margin-top:22px" class="container">
      <h2 id="impactHeading" style="margin:0 0 8px">Partner impact & success stories</h2>
      <p style="margin:0 0 12px;color:var(--muted)">How our partnerships translate into better service for customers and partners alike.</p>

      <div class="metrics" role="list" aria-label="Partner metrics">
        <div class="metric" role="listitem"><div class="num" data-target="12540">0</div><div class="small muted">Bookings supported</div></div>
        <div class="metric" role="listitem"><div class="num" data-target="98">0</div><div class="small muted">Fleet uptime (%)</div></div>
        <div class="metric" role="listitem"><div class="num" data-target="78">0</div><div class="small muted">Partner locations</div></div>
      </div>

      <div class="case-studies" aria-label="Case studies">
        <article class="case fade-in-up">
          <img src="images/hiace.jpeg" alt="Case: airport handover" loading="lazy" onerror="this.src='https://via.placeholder.com/110x72?text=Case'">
          <div>
            <strong>Airport handover pilot</strong>
            <div class="muted small">Improved pickup turnaround by 28% through coordinated logistics.</div>
          </div>
        </article>
        <article class="case fade-in-up">
          <img src="images/partner-cleaning.svg" alt="Case: maintenance" loading="lazy" onerror="this.src='https://via.placeholder.com/110x72?text=Case'">
          <div>
            <strong>Priority maintenance program</strong>
            <div class="muted small">Reduced average repair time from 48h to 12h with our maintenance partner.</div>
          </div>
        </article>
        <article class="case fade-in-up">
          <img src="images/partner-maintenance.svg" alt="Case: payments" loading="lazy" onerror="this.src='https://via.placeholder.com/110x72?text=Case'">
          <div>
            <strong>Seamless payments</strong>
            <div class="muted small">Faster reconciliations and secure collections via our payments provider.</div>
          </div>
        </article>
      </div>

      <div class="faq" aria-labelledby="faqHeading">
        <h3 id="faqHeading" style="margin:12px 0 8px">Frequently asked questions</h3>
        <div class="accordion" id="faqAcc">
          <button aria-expanded="false">How do I become a partner? <span>+</span></button>
          <div class="panel">Complete the enquiry form above or email partnerships — we’ll review and follow up with next steps.</div>
          <button aria-expanded="false">What benefits do partners get? <span>+</span></button>
          <div class="panel">Access to fleet discounts, priority service, shared marketing and logistic support depending on the tier.</div>
          <button aria-expanded="false">Is there a revenue share model? <span>+</span></button>
          <div class="panel">We offer bespoke agreements. Contact partnerships for a proposal tailored to your business.</div>
        </div>

        <div class="download-row">
          <a class="btn" href="assets/partner-pack.pdf" download>Download partner pack</a>
          <a class="ghost" href="contact.html">Request bespoke proposal</a>
        </div>
      </div>

      <div style="margin-top:18px">
        <h4 style="margin:0 0 10px">More partner logos</h4>
        <div class="logo-carousel" aria-hidden="false" role="region" aria-label="Partner logo carousel">
          <div class="logo-track" id="logoTrack">
            <img src="images/partner-insurance.png" alt="" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Insurance'">
            <img src="images/partner-maintenance.png" alt="" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Maintenance'">
            <img src="images/partner-payments.png" alt="" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Payments'">
            <img src="images/partner-logistics.png" alt="" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Logistics'">
            <img src="images/partner-cleaning.png" alt="" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Cleaning'">
            <img src="images/partner-tech.png" alt="" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Tech'">
            <!-- repeat for smooth loop -->
            <img src="images/partner-insurance.png" alt="" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Insurance'">
            <img src="images/partner-maintenance.png" alt="" loading="lazy" onerror="this.src='https://via.placeholder.com/160x36?text=Maintenance'">
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div>Questions about partnerships? Email <a href="mailto:sirmike6072@gmail.com">sirmike6072@gmail.com</a> • Phone: 0707480602</div>
    </footer>
  </div>

  <script>
    // reveal on scroll for animated entrance
    (function(){
      const items = document.querySelectorAll('.fade-in-up');
      const io = new IntersectionObserver((entries, obs)=>{
        entries.forEach(en=>{
          if(en.isIntersecting){
            en.target.classList.add('in-view');
            obs.unobserve(en.target);
          }
        });
      }, {threshold:0.12});
      items.forEach(i=> io.observe(i));
    })();

    // animate metrics counters
    (function(){
      const nums = document.querySelectorAll('.metric .num');
      if(!nums) return;
      const io = new IntersectionObserver((entries, obs)=>{
        entries.forEach(en=>{
          if(en.isIntersecting){
            const el = en.target;
            const target = Number(el.dataset.target || 0);
            let start = 0;
            const dur = 1200;
            const t0 = performance.now();
            function step(t){
              const p = Math.min(1, (t - t0) / dur);
              el.textContent = Math.floor(p * target + (1 - p) * start);
              if(p < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
            obs.unobserve(el);
          }
        });
      }, {threshold:0.3});
      nums.forEach(n=> io.observe(n));
    })();

    // accordion FAQ
    (function(){
      const acc = document.getElementById('faqAcc');
      if(!acc) return;
      acc.querySelectorAll('button').forEach(btn=>{
        btn.addEventListener('click', ()=> {
          const next = btn.nextElementSibling;
          const expanded = btn.getAttribute('aria-expanded') === 'true';
          btn.setAttribute('aria-expanded', String(!expanded));
          if(!expanded){ next.style.display = 'block'; } else { next.style.display = 'none'; }
        });
      });
    })();

    // pause logo track on hover
    (function(){
      const track = document.getElementById('logoTrack');
      if(!track) return;
      const parent = track.parentElement;
      parent.addEventListener('mouseenter', ()=> track.style.animationPlayState = 'paused');
      parent.addEventListener('mouseleave', ()=> track.style.animationPlayState = 'running');
    })();

    // partner enquiry demo handler
    (function(){
      const form = document.getElementById('partnerForm');
      if(!form) return;
      form.addEventListener('submit', (e)=>{
        e.preventDefault();
        const name = document.getElementById('pname').value.trim();
        const org = document.getElementById('porg').value.trim();
        const email = document.getElementById('pemail').value.trim();
        if(!name || !org || !email){ alert('Please complete required fields'); return; }
        // store demo enquiry locally and show a confirmation animation
        try{
          const key = 'sirmike_partnerships';
          const all = JSON.parse(localStorage.getItem(key) || '[]');
          all.unshift({ name, org, email, msg: document.getElementById('pmsg').value || '', created: new Date().toISOString() });
          localStorage.setItem(key, JSON.stringify(all));
        }catch(e){}
        const btn = form.querySelector('button');
        btn.textContent = 'Sent ✓';
        btn.disabled = true;
        setTimeout(()=> { btn.textContent = 'Send enquiry'; btn.disabled = false; form.reset(); }, 1700);
        alert('Thanks — we will review your enquiry and contact you.');
      });
    })();
  </script>
</body>
</html>


