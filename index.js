const express = require('express');
const cors = require('cors');

const app = express();
app.use(cors()); // Taaki aapka HTML is server se baat kar sake
app.use(express.json());

// 🔒 Aapki API Key yahan safe rahegi, kisi user ko nahi dikhegi
const API_KEY = "AIzaSyCfAmL_Q91j1HcEaN5SD2lg0wdB7_ZuKB4"; 

app.post('/api/chat', async (req, res) => {
    try {
        const { chatHistory } = req.body;

        // Backend se Gemini API ko call karna
        const response = await fetch(`https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=${API_KEY}`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ contents: chatHistory })
        });

        const data = await response.json();
        res.json(data);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: "Backend server error" });
    }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));