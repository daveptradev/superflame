<div id="authModal"
  class="fixed inset-0 bg-black/60 backdrop-blur-md flex items-center justify-center
  opacity-0 pointer-events-none transition z-50">

  <div id="authBox"
    class="relative w-full max-w-md p-[1px] rounded-2xl 
    bg-gradient-to-br from-red-500/40 via-transparent to-red-500/20
    opacity-0 scale-95 transition duration-300">

    <div class="bg-[#121212]/90 backdrop-blur-xl rounded-2xl p-8 border border-white/10">

      <!-- CLOSE -->
      <button onclick="closeAuth()"
        class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-xl">
        &times;
      </button>

      <!-- TITLE -->
      <h2 class="text-2xl font-extrabold text-white mb-4 tracking-widest">
        SUPERFLAME ACCESS
      </h2>

      <p class="text-gray-400 text-sm mb-6">
        Create an account to unlock <span class="text-red-500 font-semibold">exclusive drops</span>, 
        special discounts, and seamless order tracking.
      </p>

      <!-- TAB -->
      <!-- TOGGLE SWITCH -->
<div class="relative flex bg-white/5 rounded-full p-1 mb-6">

  <!-- SLIDER -->
  <div id="authSlider"
    class="absolute top-1 bottom-1 left-1 w-1/2 bg-red-600 rounded-full transition-all duration-300">
  </div>

  <button type="button"
    onclick="switchAuth('login')"
    id="tab-login"
    class="relative z-10 flex-1 py-2 text-sm font-semibold text-white transition">
    Login
  </button>

  <button type="button"
    onclick="switchAuth('register')"
    id="tab-register"
    class="relative z-10 flex-1 py-2 text-sm font-semibold text-gray-400 transition">
    Register
  </button>

</div>

      <!-- LOGIN -->

      <form id="loginForm" method="POST" action="/login" class="space-y-4">
        @csrf

               @if ($errors->has('email') && !session('switchToRegister'))
  <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-sm p-3 rounded-lg mb-4">
    {{ $errors->first('email') }}
  </div>
@endif

        <div id="login-error-box"
  class="hidden bg-red-500/10 border border-red-500/30 text-red-400 text-sm p-3 rounded-lg mb-4">
</div>
        <input type="email" id="login-email" name="email" placeholder="Email"
  class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white">
          <p class="text-red-500 text-xs mt-1 hidden" id="error-login-email"></p>

        <!-- PASSWORD -->
        <div class="relative">
  <input type="password" id="login-password" name="password"
  placeholder="Password"
  class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 pr-12 text-white">
    <p class="text-red-500 text-xs mt-1 hidden" id="error-login-password"></p>

  <button type="button"
    onclick="togglePassword('login-password', this)"
    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-white">

    <!-- EYE OPEN -->
    <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" stroke-width="1.5"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M12 15.75A3.75 3.75 0 1 0 12 8.25a3.75 3.75 0 0 0 0 7.5z"/>
    </svg>

    <!-- EYE CLOSED -->
    <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" stroke-width="1.5"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M3 3l18 18"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M10.58 10.58A3 3 0 0012 15a3 3 0 002.42-4.42"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M9.88 5.09A9.77 9.77 0 0112 5.25c6 0 9.75 6.75 9.75 6.75a15.33 15.33 0 01-4.2 4.9"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M6.1 6.1A15.32 15.32 0 002.25 12s3.75 6.75 9.75 6.75c1.2 0 2.3-.2 3.3-.6"/>
    </svg>

  </button>
</div>

        <button class="w-full bg-red-600 py-3 rounded-full font-semibold hover:bg-red-700">
          ENTER
        </button>
      </form>

      <!-- REGISTER -->
      <form id="registerForm" method="POST" action="/register"
        class="space-y-4 hidden">
        @csrf

        @if ($errors->any() && session('switchToRegister'))
  <div class="bg-red-500/10 border border-red-500/30 text-red-400 text-sm p-3 rounded-lg mb-4">
    {{ $errors->first() }}
  </div>
@endif

        <div id="register-error-box"
  class="hidden mb-4 p-3 rounded-lg bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
</div>

        <input type="text" id="register-name" name="name" placeholder="Name"
  class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white">
          <p class="error text-red-500 text-xs mt-1 hidden" id="error-name"></p>


        <input type="email" id="register-email" name="email" placeholder="Email"
  class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white">
          <p class="error text-red-500 text-xs mt-1 hidden" id="error-email"></p>

        <!-- PASSWORD -->
<div class="relative">
  <input type="password" id="register-password" name="password"
  placeholder="Password"
  class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 pr-12 text-white">
    <p class="error text-red-500 text-xs mt-1 hidden" id="error-password"></p>

  <button type="button"
    onclick="togglePassword('register-password', this)"
    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition">

    <!-- EYE OPEN -->
    <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" stroke-width="1.5"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M12 15.75A3.75 3.75 0 1 0 12 8.25a3.75 3.75 0 0 0 0 7.5z"/>
    </svg>

    <!-- EYE CLOSED -->
    <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" stroke-width="1.5"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M10.58 10.58A3 3 0 0012 15a3 3 0 002.42-4.42"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.25 12s3.75 6.75 9.75 6.75c1.2 0 2.3-.2 3.3-.6"/>
    </svg>

  </button>
</div>

<!-- CONFIRM PASSWORD -->
<div class="relative">
  <input type="password" id="confirm-password" name="password_confirmation"
  placeholder="Confirm Password"
  class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 pr-12 text-white">
    <p class="error text-red-500 text-xs mt-1 hidden" id="error-confirm"></p>
  <button type="button"
    onclick="togglePassword('confirm-password', this)"
    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-red-500 transition">

    <!-- EYE OPEN -->
    <svg class="w-5 h-5 eye-open" fill="none" stroke="currentColor" stroke-width="1.5"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.25 12s3.75-6.75 9.75-6.75S21.75 12 21.75 12s-3.75 6.75-9.75 6.75S2.25 12 2.25 12z"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M12 15.75A3.75 3.75 0 1 0 12 8.25a3.75 3.75 0 0 0 0 7.5z"/>
    </svg>

    <!-- EYE CLOSED -->
    <svg class="w-5 h-5 eye-closed hidden" fill="none" stroke="currentColor" stroke-width="1.5"
      viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M10.58 10.58A3 3 0 0012 15a3 3 0 002.42-4.42"/>
      <path stroke-linecap="round" stroke-linejoin="round"
        d="M2.25 12s3.75 6.75 9.75 6.75c1.2 0 2.3-.2 3.3-.6"/>
    </svg>

  </button>
</div>

        <button class="w-full bg-red-600 py-3 rounded-full font-semibold hover:bg-red-700">
          CREATE ACCOUNT
        </button>

        @if ($errors->any())
<script>
document.addEventListener("DOMContentLoaded", function(){

  const errors = @json($errors->all());
  const isSwitch = @json(session('switchToLogin'));

  openAuth(isSwitch ? 'login' : 'register');

  const box = document.getElementById('login-error-box');

  box.innerHTML = errors.map(err => `<div>• ${err}</div>`).join('');

  // 🔥 TAMBAH CTA
  if (isSwitch) {
    box.innerHTML += `
      <div class="mt-2 text-xs text-gray-400">
        Silakan login menggunakan email tersebut.
      </div>
    `;
  }

  box.classList.remove('hidden');

});
</script>
@endif
      </form>

    </div>
  </div>
</div>



<!-- SCRIPT TAB -->



<script>
function openAuth(type) {
  const modal = document.getElementById('authModal');
  const box = document.getElementById('authBox');

  modal.classList.remove('opacity-0','pointer-events-none');

  setTimeout(() => {
  box.classList.remove('scale-95','opacity-0');
  switchAuth(type); // 🔥 penting supaya slider ikut sync
}, 50);

  switchAuth(type);
}

function closeAuth() {
  const modal = document.getElementById('authModal');
  const box = document.getElementById('authBox');

  box.classList.add('scale-95','opacity-0');

  setTimeout(() => {
    modal.classList.add('opacity-0','pointer-events-none');
  }, 200);
}

function switchAuth(type) {

  const loginForm = document.getElementById('loginForm');
  const registerForm = document.getElementById('registerForm');

  const loginTab = document.getElementById('tab-login');
  const registerTab = document.getElementById('tab-register');
  const slider = document.getElementById('authSlider');

  if (type === 'login') {

    loginForm.classList.remove('hidden');
    registerForm.classList.add('hidden');

    loginTab.classList.add('text-white');
    loginTab.classList.remove('text-gray-400');

    registerTab.classList.add('text-gray-400');
    registerTab.classList.remove('text-white');

    slider.style.transform = "translateX(0%)";

  } else {

    loginForm.classList.add('hidden');
    registerForm.classList.remove('hidden');

    registerTab.classList.add('text-white');
    registerTab.classList.remove('text-gray-400');

    loginTab.classList.add('text-gray-400');
    loginTab.classList.remove('text-white');

    slider.style.transform = "translateX(100%)";
  }
}

// klik luar close
document.getElementById('authModal').addEventListener('click', function(e){
  if(e.target === this) closeAuth();
});

// 🔥 FIX PASSWORD TOGGLE
function togglePassword(inputId, btn){
  const input = document.getElementById(inputId);

  const eyeOpen = btn.querySelector('.eye-open');
  const eyeClosed = btn.querySelector('.eye-closed');

  if (input.type === "password") {
    input.type = "text";

    eyeOpen.classList.add("hidden");
    eyeClosed.classList.remove("hidden");

  } else {
    input.type = "password";

    eyeOpen.classList.remove("hidden");
    eyeClosed.classList.add("hidden");
  }
}
</script>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e){

  let errors = [];

  const email = document.getElementById('login-email');
  const password = document.getElementById('login-password');

  if (!email.value.includes('@')) {
    errors.push("Email tidak valid");
  }

  if (password.value.length < 6) {
    errors.push("Password minimal 6 karakter");
  }

  if (errors.length > 0) {
    e.preventDefault();

    const box = document.getElementById('login-error-box');
    box.innerHTML = errors.map(err => `<div>• ${err}</div>`).join('');
    box.classList.remove('hidden');
  }
});
</script>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e){

  let errors = [];

  const name = document.getElementById('register-name');
  const email = document.getElementById('register-email');
  const password = document.getElementById('register-password');
  const confirm = document.getElementById('confirm-password');

  if (name.value.length < 3) {
    errors.push("Nama minimal 3 karakter");
  }

  if (!email.value.includes('@')) {
    errors.push("Email tidak valid");
  }

  if (password.value.length < 6) {
    errors.push("Password minimal 6 karakter");
  }

  if (password.value !== confirm.value) {
    errors.push("Password tidak sama");
  }

  if (errors.length > 0) {
    e.preventDefault();

    const box = document.getElementById('register-error-box');
    box.innerHTML = errors.map(err => `<div>• ${err}</div>`).join('');
    box.classList.remove('hidden');
  }
});
</script>

<script>
function showError(id, message){
  const el = document.getElementById(id);
  el.innerText = message;
  el.classList.remove('hidden');
}

function resetError(id){
  const el = document.getElementById(id);
  el.innerText = '';
  el.classList.add('hidden');
}

function resetAll(){
  document.querySelectorAll('.error').forEach(el => {
    el.innerText = '';
    el.classList.add('hidden');
  });
}
</script>

@if (session('switchToLogin'))
<script>
document.addEventListener("DOMContentLoaded", function(){

  openAuth('login');

  const email = "{{ old('email') }}";

  const loginEmail = document.querySelector('#loginForm input[name="email"]');
  if (loginEmail) loginEmail.value = email;

});
</script>
@endif

@if (session('switchToRegister'))
<script>
document.addEventListener("DOMContentLoaded", function(){

  // 🔥 buka modal & pindah ke register
  openAuth('register');

  // 🔥 isi email otomatis ke register form
  const email = "{{ old('email') }}";

  const registerEmail = document.querySelector('#registerForm input[name="email"]');
  if (registerEmail) registerEmail.value = email;

});
</script>
@endif

@if (session('registerSuccess'))
<script>
document.addEventListener("DOMContentLoaded", function(){

  // 🔥 buka modal & pindah ke login
  openAuth('login');

  const box = document.getElementById('login-error-box');

  // 🔥 tampilkan success message (bukan error)
  box.innerHTML = `
    <div class="text-green-400">
      ✓ {{ session('successMessage') }}
    </div>
  `;

  box.classList.remove('hidden');

});
</script>
@endif