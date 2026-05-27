<?php 
$page_title = "Chat AI - Văn hóa Gia Lai";
include 'includes/header.php'; 
?>

<!-- Thư viện hỗ trợ -->
<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>

<style>
    :root {
        --primary-color: #28a745;
        --dark-bg: #0f0f0f;
        --card-bg: #1a1a1a;
        --border-color: #2d2d2d;
        --text-primary: #e8e8e8;
        --text-secondary: #a0a0a0;
    }

    * {
        box-sizing: border-box;
    }

    /* Tổng thể container chat */
    .chat-wrapper {
        background: var(--card-bg);
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        height: 600px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    }

    /* Header chat */
    .chat-header {
        background: linear-gradient(135deg, var(--primary-color), #20c997);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid rgba(0, 0, 0, 0.2);
    }

    .chat-header-title {
        color: white;
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .online-indicator {
        width: 8px;
        height: 8px;
        background: #fff;
        border-radius: 50%;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }

    .chat-header-actions button {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 13px;
    }

    .chat-header-actions button:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    /* Vùng tin nhắn */
    #chat-box {
        flex: 1;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        padding: 20px;
        background: var(--dark-bg);
        scroll-behavior: smooth;
    }

    /* Thanh cuộn tùy chỉnh */
    #chat-box::-webkit-scrollbar {
        width: 6px;
    }

    #chat-box::-webkit-scrollbar-track {
        background: var(--dark-bg);
    }

    #chat-box::-webkit-scrollbar-thumb {
        background: var(--border-color);
        border-radius: 10px;
    }

    #chat-box::-webkit-scrollbar-thumb:hover {
        background: #444;
    }

    /* Container tin nhắn */
    .message-container {
        display: flex;
        margin-bottom: 16px;
        animation: slideIn 0.3s ease-out;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .message {
        max-width: 75%;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 14px;
        line-height: 1.5;
        word-wrap: break-word;
        position: relative;
    }

    /* Tin nhắn người dùng */
    .user-container {
        justify-content: flex-end;
    }

    .user-message {
        background: var(--primary-color);
        color: white;
        border-bottom-right-radius: 4px;
        box-shadow: 0 2px 8px rgba(40, 167, 69, 0.2);
    }

    .user-message code {
        background: rgba(0, 0, 0, 0.2);
        padding: 2px 6px;
        border-radius: 4px;
        font-size: 12px;
    }

    /* Tin nhắn AI */
    .ai-container {
        justify-content: flex-start;
    }

    .ai-message {
        background: var(--card-bg);
        color: var(--text-primary);
        border-bottom-left-radius: 4px;
        border: 1px solid var(--border-color);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .ai-message a {
        color: var(--primary-color);
        text-decoration: none;
        transition: all 0.2s;
    }

    .ai-message a:hover {
        text-decoration: underline;
    }

    .ai-message pre {
        background: #0d0d0d;
        border: 1px solid var(--border-color);
        border-radius: 6px;
        padding: 12px;
        overflow-x: auto;
        margin: 8px 0;
    }

    .ai-message code {
        font-family: 'Courier New', monospace;
        font-size: 12px;
        color: #58b368;
    }

    .ai-message ul, .ai-message ol {
        margin: 8px 0;
        padding-left: 20px;
    }

    .ai-message li {
        margin: 4px 0;
    }

    .ai-message strong {
        color: var(--primary-color);
    }

    /* Chỉ báo đang gõ */
    .typing-indicator {
        background: none !important;
        border: none !important;
        padding: 8px 0 !important;
    }

    .typing-dots {
        display: flex;
        gap: 4px;
        align-items: center;
    }

    .dot {
        width: 6px;
        height: 6px;
        background: var(--text-secondary);
        border-radius: 50%;
        animation: bounce 1.4s infinite;
    }

    .dot:nth-child(1) { animation-delay: 0s; }
    .dot:nth-child(2) { animation-delay: 0.2s; }
    .dot:nth-child(3) { animation-delay: 0.4s; }

    @keyframes bounce {
        0%, 100% { opacity: 0.3; transform: translateY(0); }
        50% { opacity: 1; transform: translateY(-6px); }
    }

    /* Ô nhập liệu */
    .input-area {
        background: var(--card-bg);
        padding: 15px;
        border-top: 1px solid var(--border-color);
    }

    .input-group-custom {
        display: flex;
        gap: 10px;
        align-items: flex-end;
    }

    #user-input {
        flex: 1;
        background: var(--border-color) !important;
        border: 1px solid #3d3d3d !important;
        color: var(--text-primary) !important;
        padding: 10px 14px !important;
        border-radius: 8px !important;
        font-size: 14px !important;
        resize: none;
        max-height: 100px;
        transition: all 0.3s ease;
    }

    #user-input:focus {
        outline: none;
        border-color: var(--primary-color) !important;
        background: #252525 !important;
        box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.1);
    }

    #user-input::placeholder {
        color: var(--text-secondary);
    }

    #btn-send {
        background: var(--primary-color);
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 6px;
        height: 40px;
    }

    #btn-send:hover {
        background: #20c997;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
    }

    #btn-send:active {
        transform: translateY(0);
    }

    #btn-send:disabled {
        background: var(--text-secondary);
        cursor: not-allowed;
        transform: none;
    }

    /* Thông báo lỗi */
    .error-message {
        background: #8b0000 !important;
        border-left: 3px solid #ff4444 !important;
    }

    /* Welcome message */
    .welcome-message {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.1), rgba(32, 201, 151, 0.1));
        border: 1px solid rgba(40, 167, 69, 0.3);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .message {
            max-width: 90%;
            font-size: 13px;
        }

        .chat-wrapper {
            height: 500px;
        }

        .chat-header-title {
            font-size: 14px;
        }
    }

    /* Char counter */
    .char-counter {
        font-size: 12px;
        color: var(--text-secondary);
        margin-top: 4px;
        text-align: right;
    }

    .char-counter.warning {
        color: #ffc107;
    }

    .char-counter.limit {
        color: #dc3545;
    }
</style>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="chat-wrapper">
                <!-- Header -->
                <div class="chat-header">
                    <h5 class="chat-header-title">
                        <span class="online-indicator"></span>
                        <i class="fas fa-robot"></i> Cố vấn Du lịch Gia Lai
                    </h5>
                    <div class="chat-header-actions">
                        <button onclick="clearChat()" title="Xóa cuộc trò chuyện">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </div>
                </div>

                <!-- Chat Box -->
                <div id="chat-box">
                    <div class="message-container ai-container">
                        <div class="message ai-message welcome-message">
                            <strong>👋 Chào mừng!</strong><br>
                            Tôi là trợ lý ảo chuyên biết về văn hóa Gia Lai. Hỏi tôi bất cứ điều gì về:
                            <ul style="margin-top: 8px; margin-bottom: 0;">
                                <li>🏛️ Di sản văn hóa và lịch sử</li>
                                <li>👥 Các dân tộc: Bahnar, Jrai, Ê Đê...</li>
                                <li>🍜 Ẩm thực đặc sắc (phở khô, gỏi lá)</li>
                                <li>🎭 Lễ hội truyền thống</li>
                                <li>🏞️ Điểm du lịch nổi bật</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="input-area">
                    <div class="input-group-custom">
                        <textarea 
                            id="user-input" 
                            class="form-control" 
                            placeholder="Nhập câu hỏi của bạn."
                            rows="1"
                            maxlength="1000"
                        ></textarea>
                        <button id="btn-send" onclick="sendMessage()">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                    <div class="char-counter">
                        <span id="char-count">0</span>/1000
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const chatBox = document.getElementById('chat-box');
    const userInput = document.getElementById('user-input');
    const btnSend = document.getElementById('btn-send');
    const charCount = document.getElementById('char-count');

    // API Configuration
    const API_CONFIG = {
        endpoint: 'https://api.groq.com/openai/v1/chat/completions',
        apiKey: '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', //KEY
        model: 'llama-3.1-8b-instant',
        maxTokens: 1024
    };

    // Character counter
    userInput.addEventListener('input', (e) => {
        charCount.textContent = e.target.value.length;
        adjustTextareaHeight();
        
        const counter = charCount.parentElement;
        if (e.target.value.length > 900) {
            counter.classList.add('warning');
        }
        if (e.target.value.length > 950) {
            counter.classList.add('limit');
        }
        if (e.target.value.length <= 900) {
            counter.classList.remove('warning', 'limit');
        }
    });

    // Auto-adjust textarea height
    function adjustTextareaHeight() {
        userInput.style.height = 'auto';
        userInput.style.height = Math.min(userInput.scrollHeight, 100) + 'px';
    }

    // Append message to chat
    function appendMessage(role, text, isError = false) {
        const container = document.createElement('div');
        container.className = `message-container ${role === 'user' ? 'user-container' : 'ai-container'}`;

        const msgDiv = document.createElement('div');
        msgDiv.className = `message ${role === 'user' ? 'user-message' : 'ai-message'}`;
        if (isError) msgDiv.classList.add('error-message');

        if (role === 'ai') {
            try {
                msgDiv.innerHTML = marked.parse(text);
                // Highlight code blocks
                msgDiv.querySelectorAll('code').forEach(block => {
                    if (block.parentElement.tagName === 'PRE') {
                        hljs.highlightElement(block);
                    }
                });
            } catch(e) {
                msgDiv.textContent = text;
                console.error('Markdown parse error:', e);
            }
        } else {
            msgDiv.textContent = text;
        }

        container.appendChild(msgDiv);
        chatBox.appendChild(container);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Show typing indicator
    function showTypingIndicator() {
        const container = document.createElement('div');
        container.className = 'message-container ai-container';
        container.id = 'loading-indicator';

        const msgDiv = document.createElement('div');
        msgDiv.className = 'message ai-message typing-indicator';
        msgDiv.innerHTML = `
            <div class="typing-dots">
                <div class="dot"></div>
                <div class="dot"></div>
                <div class="dot"></div>
            </div>
        `;

        container.appendChild(msgDiv);
        chatBox.appendChild(container);
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    // Remove typing indicator
    function removeTypingIndicator() {
        const loader = document.getElementById('loading-indicator');
        if (loader) loader.remove();
    }

    // Send message
    async function sendMessage() {
        const message = userInput.value.trim();
        if (!message) return;

        // Disable send button
        btnSend.disabled = true;

        // Add user message
        appendMessage('user', message);
        userInput.value = '';
        charCount.textContent = '0';
        adjustTextareaHeight();

        // Show typing indicator
        showTypingIndicator();

        try {
            const response = await fetch(API_CONFIG.endpoint, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${API_CONFIG.apiKey}`
                },
                body: JSON.stringify({
                    model: API_CONFIG.model,
                    max_tokens: API_CONFIG.maxTokens,
                    messages: [
                        {
                            role: "system",
                            content: `Bạn là một cố vấn du lịch và hướng dẫn viên ảo chuyên sâu về Gia Lai, Việt Nam. 
                            Bạn am hiểu về:
                            - Di sản văn hóa và lịch sử Gia Lai
                            - Các dân tộc: Bahnar, Jrai, Ê Đê và các nhóm dân tộc khác
                            - Ẩm thực đặc sắc như phở khô, gỏi lá, cơm lam
                            - Lễ hội truyền thống và phong tục tập quán
                            - Các điểm du lịch nổi bật: Chư Pông Rơ May, Biển Hồ, Thác Yali...
                            
                            Hướng dẫn:
                            - Trả lời ngắn gọn, thân thiện bằng tiếng Việt
                            - Sử dụng emoji một cách hợp lý
                            - Cung cấp thông tin chính xác và hữu ích
                            - Nếu không biết, hãy thề nhận và đề xuất tìm hiểu thêm
                            - Định dạng tốt: sử dụng danh sách, tiêu đề khi cần thiết`
                        },
                        { role: "user", content: message }
                    ]
                })
            });

            const data = await response.json();
            removeTypingIndicator();

            if (!response.ok) {
                throw new Error(data.error?.message || 'Lỗi API');
            }

            if (data.choices?.[0]?.message?.content) {
                appendMessage('ai', data.choices[0].message.content);
            } else {
                appendMessage('ai', '❌ Rất tiếc, tôi không nhận được dữ liệu từ API. Vui lòng kiểm tra API Key!', true);
            }

        } catch (error) {
            removeTypingIndicator();
            console.error("Lỗi:", error);
            
            let errorMsg = '❌ Lỗi kết nối. ';
            if (error.message.includes('Failed to fetch')) {
                errorMsg += 'Kiểm tra kết nối Internet của bạn.';
            } else if (error.message.includes('API')) {
                errorMsg += 'Vui lòng kiểm tra API Key và cấu hình.';
            } else {
                errorMsg += error.message;
            }
            
            appendMessage('ai', errorMsg, true);
        } finally {
            btnSend.disabled = false;
            userInput.focus();
        }
    }

    // Clear chat history
    function clearChat() {
        if (confirm('Bạn chắc chắn muốn xóa toàn bộ cuộc trò chuyện?')) {
            chatBox.innerHTML = `
                <div class="message-container ai-container">
                    <div class="message ai-message welcome-message">
                        <strong>👋 Chào mừng!</strong><br>
                        Tôi là trợ lý ảo chuyên biết về văn hóa Gia Lai. Hỏi tôi bất cứ điều gì về:
                        <ul style="margin-top: 8px; margin-bottom: 0;">
                            <li>🏛️ Di sản văn hóa và lịch sử</li>
                            <li>👥 Các dân tộc: Bahnar, Jrai, Ê Đê...</li>
                            <li>🍜 Ẩm thực đặc sắc (phở khô, gỏi lá)</li>
                            <li>🎭 Lễ hội truyền thống</li>
                            <li>🏞️ Điểm du lịch nổi bật</li>
                        </ul>
                    </div>
                </div>
            `;
            userInput.focus();
        }
    }

    // Keyboard shortcuts
    userInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && e.ctrlKey) {
            sendMessage();
        }
    });

    // Initialize
    userInput.focus();
</script>

<?php include 'includes/footer.php'; ?>
