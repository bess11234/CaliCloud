const ip = "18.233.7.46"
const signOutPath = `https://calicloudgooglev2.auth.us-east-1.amazoncognito.com/logout?client_id=7uvm35k22tckpfkhbq46b7jkut&redirect_uri=https%3A%2F%2F${ip}%2Fbackend%2Fcredential.php&response_type=code`
const signInPath = `https://calicloudgooglev2.auth.us-east-1.amazoncognito.com/login?client_id=7uvm35k22tckpfkhbq46b7jkut&response_type=code&scope=email+openid+profile&redirect_uri=https%3A%2F%2F${ip}%2Fbackend%2Fcredential.php`

const logout_box = document.getElementById("logout_box")
const show_name = document.getElementById("show_name")
const show_book = document.getElementById("show_book")
const show_signout = document.getElementById("show_signout")

show_name.addEventListener("click", () => showLogout())
show_signout.addEventListener("click", () => signout())

function signout() {
    fetch("/backend/signout.php", {
        method: "POST"
    })
    .then(() => {
        location.href = signOutPath
    })
}

function showLogout() {
    if (!logout_box.classList.contains("hidden")) {
        logout_box.classList.toggle("opacity-0")
        logout_box.classList.toggle("translate-y-full")
        setTimeout(() => {
            logout_box.classList.toggle("hidden")
        }, 300)
    } else {
        logout_box.classList.toggle("hidden")
        setTimeout(() => {
            logout_box.classList.toggle("opacity-0")
            logout_box.classList.toggle("translate-y-full")
        }, 300)
    }
}

const signin = document.querySelector("#signin")

fetch("/backend/retrieveuser.php", {
    method: "GET",
    headers: {
        'Content-Type': 'application/json'
    }
})
.then((response) => {
    // console.log('Response:', response); // Log the whole response object
    if (!response.ok) {
        signin.innerHTML = `<a href="${signInPath}">
        <button id="bSignin" class="bg-blue-500 hover:bg-blue-600 active:bg-blue-700 text-white px-3 py-2 rounded-lg">Sign in</button>
        </a>`
        throw new Error(`HTTP error! Status: ${response.status}`);
    }
    return response.json(); // Proceed to parse JSON if response is okay
})
.then(data => {
    if (data['userdata']['name']) {
        signin.innerHTML = `
    <p id="show_name" class="select-none cursor-pointer">${data['userdata']['name']}</p>
    <div id="logout_box"
        class="absolute transition-all bg-black2 border border-gray-950 hidden opacity-0 translate-y-full top-8 right-0 p-3 rounded shadow">
        <a href="/page/booking.html" class="cursor-pointer w-32 hover:opacity-50">Booking</a>
        <p id="show_signout" class="cursor-pointer w-32 hover:opacity-50">Sign out</p>
    </div>
    `
    }
})