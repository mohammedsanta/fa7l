<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title')</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* 🔥 مهم عشان يمنع خروج العناصر برا البوكس */
*,
*::before,
*::after{
    box-sizing: border-box;
}

body{
margin:0;
font-family:'Segoe UI',sans-serif;
background:linear-gradient(135deg,#0f2027,#203a52,#2c5364);
display:flex;
justify-content:center;
align-items:center;
min-height:100vh;
color:white;
padding:20px;
}

.card{
background:rgba(255,255,255,0.08);
backdrop-filter:blur(20px);
padding:40px;
border-radius:25px;
width:100%;
max-width:380px; /* ✅ مهم */
box-shadow:0 20px 60px rgba(0,0,0,0.6);
}

/* ================= INPUT ================= */

.input-group{
position:relative;
margin-bottom:20px;
}

.input-group i{
position:absolute;
left:12px;
top:50%;
transform:translateY(-50%);
color:#00e5ff;
}

.input-group input{
width:100%;
max-width:100%;
padding:12px 45px;
border-radius:12px;
border:none;
outline:none;
font-size:14px;
background:rgba(255,255,255,0.15);
color:white;
display:block;
}

/* ================= ERRORS ================= */

.error{
color:#ff4d4d;
font-size:13px;
margin-top:-8px;
margin-bottom:10px;
display:none;
}

/* ================= BUTTON ================= */

button.login-btn{
width:100%;
padding:14px;
background:#ff9800;
border:none;
border-radius:12px;
font-weight:bold;
cursor:pointer;
font-size:15px;
transition:0.3s;
color:white;
}

button.login-btn:hover{
background:#ffa733;
transform:scale(1.03);
}

/* ================= SPINNER ================= */

.spinner{
display:none;
width:18px;
height:18px;
border:3px solid white;
border-top:3px solid transparent;
border-radius:50%;
animation:spin 0.8s linear infinite;
margin:auto;
}

@keyframes spin{
from{transform:rotate(0deg);}
to{transform:rotate(360deg);}
}

/* ================= LINKS ================= */

.link{
text-align:center;
margin-top:15px;
font-size:14px;
}

.link a{
color:#00e5ff;
text-decoration:none;
font-weight:bold;
}

.toggle-btn{
margin-top:-15px;
margin-bottom:15px;
text-align:right;
}

.toggle-btn button{
background:none;
border:none;
color:white;
cursor:pointer;
font-size:14px;
}

</style>

@stack('styles')

</head>
<body>

@yield('content')

@stack('scripts')

</body>
</html>