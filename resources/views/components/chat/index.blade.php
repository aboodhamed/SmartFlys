<x-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/DataManager.css') }}">
    <link rel="stylesheet" href="{{ asset('css/FlightDetails.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Flights.css') }}">
    <link rel="stylesheet" href="{{ asset('css/SmartChat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/SmartDataChat.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jordanian-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/simplified-flights.css') }}">

    @push('styles')
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f5f5f5;
                margin: 0;
                padding: 0;
            }

            .chat-container {
                max-width: 500px;
                margin: 40px auto;
                background: #fff;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                display: flex;
                flex-direction: column;
                height: 600px;
            }

            .chat-messages {
                flex: 1;
                padding: 16px;
                overflow-y: auto;
            }

            .message {
                margin-bottom: 12px;
                display: flex;
                flex-direction: column;
            }

            .message.user {
                align-items: flex-end;
            }

            .message.ai {
                align-items: flex-start;
            }

            .message-content {
                background: #e0e0e0;
                padding: 10px 14px;
                border-radius: 12px;
                max-width: 80%;
            }

            .message.user .message-content {
                background: #5a9a9c;
                color: #fff;
            }

            .message-header {
                font-size: 12px;
                color: #555;
                display: flex;
                justify-content: space-between;
                margin-bottom: 4px;
            }

            .typing-indicator {
                display: none;
                flex-direction: row;
                align-items: center;
                gap: 4px;
                padding: 10px;
            }

            .typing-indicator span {
                width: 6px;
                height: 6px;
                background: #555;
                border-radius: 50%;
                animation: blink 1s infinite;
            }

            .typing-indicator span:nth-child(2) { animation-delay: 0.2s; }
            .typing-indicator span:nth-child(3) { animation-delay: 0.4s; }

            @keyframes blink {
                0%, 80%, 100% { opacity: 0; }
                40% { opacity: 1; }
            }

            .chat-input {
                border-top: 1px solid #ddd;
                padding: 10px;
                display: flex;
                gap: 8px;
            }

            .chat-input input {
                flex: 1;
                padding: 10px;
                border-radius: 8px;
                border: 1px solid #ccc;
            }

            .chat-input button {
                padding: 0 16px;
                border: none;
                border-radius: 8px;
                background: #5a9a9c;
                color: #fff;
                cursor: pointer;
            }

            .quick-suggestions {
                margin-top: 12px;
                padding: 0 16px 16px 16px;
            }

            .quick-suggestions h4 {
                margin: 0 0 6px 0;
                font-size: 14px;
                color: #333;
            }

            .suggestions-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 6px;
            }

            .suggestion-btn {
                background: #f0f0f0;
                border: none;
                padding: 6px 10px;
                border-radius: 6px;
                cursor: pointer;
                font-size: 13px;
            }

            .suggestion-btn:hover {
                background: #ddd;
            }

            .confidence-badge {
                font-size: 11px;
                background: #28a745;
                color: #fff;
                padding: 2px 6px;
                border-radius: 8px;
                margin-top: 4px;
                display: inline-block;
            }

            #stats {
                font-size: 12px;
                text-align: center;
                padding: 6px 0;
                color: #555;
            }
        </style>
    @endpush

    <div class="container py-5">
        <!-- Introduction -->
        <div class="intro mb-8 text-center bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-8 px-6 rounded-2xl shadow-lg">
            <h1 class="display-5 fw-bold mb-3">
                <span class="title-inline">
                    <i class="fas fa-plane text-warning"></i>
                    <span>SmartData Chat</span>
                </span>
            </h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">Ask about flights, baggage, check-in, or any travel-related queries with SmartFly's AI-powered assistant.</p>
        </div>

        <!-- Chat Interface -->
        <div class="row g-4">
            <div class="col-12">
                <div class="chat-container">
                    <div class="chat-messages" id="chatMessages"></div>

                    <!-- Typing Indicator -->
                    <div class="typing-indicator" id="typingIndicator">
                        <span></span><span></span><span></span>
                    </div>

                    <div class="chat-input">
                        <input type="text" id="chatInput" placeholder="اكتب سؤالك هنا...">
                        <button id="sendBtn"><i class="fas fa-paper-plane"></i></button>
                    </div>

                    <div class="quick-suggestions">
                        <h4>اقتراحات سريعة:</h4>
                        <div class="suggestions-grid" id="suggestionsGrid"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Why Choose SmartFly Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="bg-white shadow-sm p-5 rounded text-center">
                    <h3 class="mb-4">
                        <i class="fas fa-star me-2 text-warning"></i> Why choose SmartFly?
                    </h3>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <i class="fas fa-shield-alt mb-3 fs-2 text-primary"></i>
                            <h5>Safety and Reliability</h5>
                            <p class="text-muted">Our partnerships with top Jordanian airlines ensure safe and reliable journeys</p>
                        </div>
                        <div class="col-md-4 mb-4">
                            <i class="fas fa-tags mb-3 fs-2 text-success"></i>
                            <h5>Best Prices</h5>
                            <p class="text-muted">We bring you the best deals and fares from all Jordanian airlines</p>
                        </div>
                        <div class="col-md-4 mb-4">
                            <i class="fas fa-headset mb-3 fs-2 text-info"></i>
                            <h5>24/7 Support</h5>
                            <p class="text-muted">Our support team is available around the clock to assist you anytime</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    @push('scripts')
        <script>
            // ===== Global variables =====
            let knowledgeBase = {};
            let stats = { localResponses: 0, apiCallsSaved: 0, apiCallsMade: 0, totalResponseTime: 0 };

            // ===== Initialize chatbot =====
            async function initChatbot() {
                try {
                    const response = await fetch('{{ asset('dataset.json') }}');
                    knowledgeBase = await response.json();
                    console.log('Knowledge base loaded with', Object.keys(knowledgeBase).length, 'entries');
                } catch (e) {
                    console.error('Error loading knowledge base:', e);
                    addMessage('ai', 'Error loading knowledge base.');
                }
            }

            // ===== Levenshtein distance =====
            function levenshteinDistance(a, b) {
                const matrix = [];
                for (let i = 0; i <= b.length; i++) matrix[i] = [i];
                for (let j = 0; j <= a.length; j++) matrix[0][j] = j;
                for (let i = 1; i <= b.length; i++) {
                    for (let j = 1; j <= a.length; j++) {
                        if (b[i - 1] === a[j - 1]) matrix[i][j] = matrix[i - 1][j - 1];
                        else matrix[i][j] = Math.min(matrix[i - 1][j - 1] + 1, matrix[i][j - 1] + 1, matrix[i - 1][j] + 1);
                    }
                }
                return matrix[b.length][a.length];
            }

            // ===== Fuzzy match =====
            function fuzzyMatch(query, choices, threshold = 0.7) {
                if (!choices || Object.keys(choices).length === 0) return null;
                const queryWords = query.toLowerCase().split(/\s+/).filter(w => w.length > 2);
                let bestMatch = null, bestScore = 0;

                for (const [key, value] of Object.entries(choices)) {
                    if (key.toLowerCase() === query.toLowerCase()) return { key, value, confidence: 1.0 };
                    const keyWords = key.toLowerCase().split(/\s+/);
                    let matchedWords = 0;
                    for (const qWord of queryWords) {
                        for (const kWord of keyWords) {
                            if (kWord.includes(qWord) || qWord.includes(kWord)) { matchedWords++; break; }
                        }
                    }
                    const wordScore = matchedWords / Math.max(queryWords.length, keyWords.length);
                    const distance = levenshteinDistance(query.toLowerCase(), key.toLowerCase());
                    const similarityScore = 1 - distance / Math.max(query.length, key.length);
                    const combinedScore = wordScore * 0.7 + similarityScore * 0.3;
                    if (combinedScore > bestScore && combinedScore >= threshold) {
                        bestScore = combinedScore;
                        bestMatch = { key, value, confidence: combinedScore };
                    }
                }
                return bestMatch;
            }

            // ===== Find best match =====
            function findBestMatch(query) {
                const start = performance.now();
                if (knowledgeBase[query.toLowerCase()]) return { answer: knowledgeBase[query.toLowerCase()], confidence: 1.0, responseTime: performance.now() - start };
                const fuzzy = fuzzyMatch(query, knowledgeBase, 0.9);
                if (fuzzy) return { answer: fuzzy.value, confidence: fuzzy.confidence, responseTime: performance.now() - start };

                const keywords = {
                    'baggage': 'baggage allowance', 'luggage': 'baggage allowance', 'flight': 'flight status', 'status': 'flight status',
                    'checkin': 'check-in time', 'seat': 'seat selection', 'upgrade': 'upgrade my seat', 'refund': 'refund policy',
                    'cancel': 'cancellation fee', 'delay': 'flight delayed', 'wifi': 'wifi on board', 'meal': 'special meals',
                    'pet': 'traveling with pets', 'visa': 'visa requirements', 'insurance': 'travel insurance'
                };

                for (const [kw, fallback] of Object.entries(keywords)) {
                    if (query.toLowerCase().includes(kw) && knowledgeBase[fallback]) {
                        return { answer: knowledgeBase[fallback], confidence: 0.5, responseTime: performance.now() - start };
                    }
                }

                return { answer: "عذراً، لا أملك معلومات عن هذا. حاول السؤال عن الأمتعة، حالة الرحلة، تسجيل الوصول، أو مواضيع سفر أخرى.", confidence: 0, responseTime: performance.now() - start };
            }

            // ===== Add message =====
            function addMessage(sender, message, confidence = null) {
                const chatMessages = document.getElementById('chatMessages');
                if (!chatMessages) return;
                const messageDiv = document.createElement('div');
                messageDiv.className = `message ${sender === 'bot' || sender === 'ai' ? 'ai' : 'user'}`;

                const bubbleDiv = document.createElement('div');
                bubbleDiv.className = 'message-content';
                bubbleDiv.innerHTML = message;

                messageDiv.appendChild(bubbleDiv);
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }

            // ===== Typing indicator =====
            function showTypingIndicator() {
                const el = document.getElementById('typingIndicator');
                if (el) el.style.display = 'flex';
            }
            function hideTypingIndicator() {
                const el = document.getElementById('typingIndicator');
                if (el) el.style.display = 'none';
            }

            // ===== Send message =====
            async function sendMessage() {
                const input = document.getElementById('chatInput');
                if (!input) return;
                const message = input.value.trim();
                if (!message) return;
                addMessage('user', message);
                input.value = '';

                showTypingIndicator();
                setTimeout(async () => {
                    hideTypingIndicator();
                    const result = findBestMatch(message);

                    if (result.confidence > 0.7) {
                        stats.localResponses++;
                        stats.apiCallsSaved++;
                        stats.totalResponseTime += result.responseTime;
                        addMessage('ai', result.answer, result.confidence);
                        updateStatsDisplay();
                        addSuggestions();
                    } else {
                        try {
                            const apiResp = await fetch("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent", {
                                method: "POST",
                                headers: { "Content-Type": "application/json", "X-goog-api-key": "AIzaSyCv6n_FzsBcaA4gc0CyguoB2CfNWC1y1mo" },
                                body: JSON.stringify({
                                    contents: [{
                                        parts: [{
                                            text: "You are a flight assistant that ONLY answers about flights, aviation, and travel specifically in Jordan (Royal Jordanian, Queen Alia Airport, baggage rules, visas for Jordan, etc.). " +
                                                "Keep answers clear, short (2–5 sentences max), and without markdown formatting. " +
                                                "The user asked: " + message
                                        }]
                                    }]
                                })
                            });
                            const data = await apiResp.json();
                            const answer = data?.candidates?.[0]?.content?.parts?.[0]?.text || "عذراً، لا يوجد جواب من Gemini.";
                            addMessage('ai', answer);
                            stats.apiCallsMade++;
                            updateStatsDisplay();
                        } catch (e) {
                            addMessage('ai', "حدث خطأ أثناء الاتصال بـ Gemini API.");
                        }
                    }
                }, 500 + Math.random() * 500);
            }

            // ===== Suggestions =====
            function sendSuggestion(button) {
                const input = document.getElementById('chatInput');
                if (!input) return;
                input.value = button.textContent;
                sendMessage();
            }

            function addSuggestions() {
                const suggestions = ['Baggage allowance', 'Flight status check', 'Online check-in', 'Seat selection fee', 'Upgrade options', 'Cancellation policy', 'Special meals', 'WiFi availability'];
                const shuffled = suggestions.sort(() => 0.5 - Math.random()).slice(0, 4);
                const lastBot = document.querySelector('.message.ai:last-child .message-content');
                if (lastBot) {
                    const div = document.createElement('div'); div.className = 'suggestions-grid';
                    div.innerHTML = shuffled.map(s => `<button class="suggestion-btn" onclick="sendSuggestion(this)">${s}</button>`).join('');
                    lastBot.appendChild(div);
                }
            }

            // ===== Stats display =====
            function updateStatsDisplay() {
                const statsDiv = document.getElementById('stats');
                if (!statsDiv) return;
                const avg = stats.localResponses > 0 ? (stats.totalResponseTime / stats.localResponses).toFixed(0) : 0;
                statsDiv.textContent = `Local responses: ${stats.localResponses} • API calls saved: ${stats.apiCallsSaved} • API calls made: ${stats.apiCallsMade} • Avg response time: ${avg}ms`;
            }

            // ===== Initialize everything after DOM loaded =====
            window.addEventListener('load', () => {
                initChatbot();

                const chatInput = document.getElementById('chatInput');
                const sendBtn = document.getElementById('sendBtn');

                if (chatInput) chatInput.addEventListener('keypress', e => { if (e.key === 'Enter') sendMessage(); });
                if (sendBtn) sendBtn.addEventListener('click', sendMessage);

                updateStatsDisplay(); // initialize stats div
            });
        </script>
    @endpush
</x-layout>