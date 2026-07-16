# 📹 WebRTC Camera Stream

**Simple peer-to-peer live video streaming** – share your camera or screen directly from your browser with a receiver via a unique Stream ID. Version **1.1** – developed by Kevin Tobler 🌐 [www.kevintobler.ch](https://www.kevintobler.ch)

---

## 🔄 Changelog

### 🆕 Version 1.x
- **1.1**
  - 🖥️ Share your screen in addition to the camera stream
  - 🔄 Switch between camera and screen sharing during an active stream
  - 🎥 Camera selection is shown only after the camera stream is started
  - 🔄 Switch cameras automatically by selecting another camera from the dropdown
  - 🔑 Stream ID stays available after ending a stream and can be reused
  - ♻️ Generate a new Stream ID manually with the reload button
  - ✨ Updated sender UI labels: “Share camera”, “Share screen” and “Switch to screen”

- **1.0**
  - 📹 Start live video directly from your browser (desktop or mobile)  
  - 🔗 Share the stream via a unique Stream ID  
  - 📋 One-click copy of the Stream ID or a ready-to-use receiver link  
  - 🔄 Switch between front and back camera (on supported devices)  
  - 🎥 Select specific cameras from a list (desktop devices)  
  - ❌ End a stream manually (Sender clears all signals, Receiver can send “Bye”)  
  - 🌍 Works without plugins – pure WebRTC + PHP signaling

---

## 🚀 Features

- 🎥 Real-time **WebRTC camera and screen streaming** between browsers  
- 🖥️ Share your screen or a selected window directly from the browser
- 🔄 Switch between camera and screen sharing while the stream is active
- 🔑 **Stream ID** is randomly generated and can be reused after ending a stream
- ♻️ Generate a new Stream ID manually when needed
- 📋 Copy Stream ID or full Receiver link with one click  
- 🔄 **Switch cameras** (front/back on mobile, device selection on desktop)  
- 🗑️ Automatic cleanup of old signaling files  
- ✅ No database required – signaling stored as temporary JSON files  
- 🌐 Works on modern browsers (Chrome, Firefox, Safari, Edge)  

---

## 📸 Screenshot

![Screenshot](https://online.kevintobler.ch/projectimages/WebRTCCameraStreamV1-0.png)

---

## 🌍 Online Demo

Try WebRTC Camera Stream directly in your browser:  
🔗 [https://webrtc.kevintobler.ch](https://webrtc.kevintobler.ch)

---

## 🔧 Installation

1. Upload all files (`index.html`, `sender.html`, `receiver.html`, `signal.php`, `css`, `img`) to your web server  
2. Ensure PHP and HTTPS is enabled (⚠️ PHP 7.4 or higher and TLS/HTTPS required)  
3. Make sure the server allows writing to the `/signals` directory (created automatically and protected with .htaccess)  
4. Share the Stream ID or the Receiver link with your viewer  

---

## ⚙️ How It Works

- **Sender** opens `sender.html` and starts a camera or screen stream → a new random Stream ID is created.  
- **Receiver** opens `receiver.html` and enters the same Stream ID.  
- Both communicate via the **signaling server** (`signal.php`), which exchanges:
  - 📤 Offers & Answers (SDP)  
  - ❄️ ICE candidates (STUN connectivity)  
  - 🚫 Bye messages (to end streams)  
- Once connected, the video/audio stream flows directly peer-to-peer (encrypted).  

---

## 🔒 Security

- All signaling data is stored as temporary JSON files on the server (auto-deleted after 24h).  
- Access to the `/signals` directory is blocked via `.htaccess`.  
- Media streams are **end-to-end encrypted** by WebRTC.  
- Stream IDs are random 6-digit numbers and can be reused until the sender generates a new ID or reloads the page.  

---

## 🧑‍💻 Developer

**Kevin Tobler**  
🌐 [www.kevintobler.ch](https://www.kevintobler.ch)

---

## 📜 License

This project is licensed under the **MIT License** – feel free to use, modify, and distribute.
