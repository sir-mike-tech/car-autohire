Formspree integration added to `contact.html`

What I changed

- Updated the contact form in `contact.html` to POST to your Formspree endpoint:
  - form action: https://formspree.io/f/xgvrekyn
  - method: POST
  - hidden inputs: `_subject` and `_captcha=false`
- Updated the client-side submit handler to send a FormData POST to the form action using fetch(), and kept the existing localStorage backup + success UI.

How to verify

1. Open the contact page in a browser and submit the form.
2. Check Network tab in DevTools for a POST to https://formspree.io/f/xgvrekyn and confirm a 200/202 response.
3. Check your Formspree inbox or email for the submission.

Notes

- Formspree returns JSON when `Accept: application/json` is sent — the script checks for `response.ok` and shows an error message on failure.
- If you prefer server-side handling (recommended for full control), replace the fetch block with a POST to your server endpoint.
- Test in an incognito window to avoid extensions interfering with the request.
