const ip = "18.233.7.46"
const signOutPath = `https://calicloudgooglev2.auth.us-east-1.amazoncognito.com/logout?client_id=7uvm35k22tckpfkhbq46b7jkut&redirect_uri=https%3A%2F%2F${ip}%2Fbackend%2Fcredential.php&response_type=code`
const signInPath = `https://calicloudgooglev2.auth.us-east-1.amazoncognito.com/login?client_id=7uvm35k22tckpfkhbq46b7jkut&response_type=code&scope=email+openid+profile&redirect_uri=https%3A%2F%2F${ip}%2Fbackend%2Fcredential.php`

function signout() {
    fetch("/backend/signout.php", {
        method: "POST"
    })
    .then(() => {
        location.href = signOutPath
    })
}

function showLogout() {
    const logout_box = document.getElementById("logout_box")
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
        signin.innerHTML = ""

        let show_name_user = document.createElement("p")
        let div = document.createElement("div")
        let a_link = document.createElement("p")
        let show_sign_out = document.createElement("p")

        show_name_user.className = "select-none cursor-pointer"
        show_name_user.innerText = data['userdata']['name']
        show_name_user.addEventListener("click", () => showLogout())
        signin.append(show_name_user)

        a_link.className = "cursor-pointer w-32 hover:opacity-50"
        a_link.innerText = "Booking"
        a_link.addEventListener("click", ()=> location.href="/page/booking.html")
        div.append(a_link)

        show_sign_out.className = "cursor-pointer w-32 hover:opacity-50"
        show_sign_out.innerText = "Sign out"
        show_sign_out.addEventListener("click", () => signout())
        div.append(show_sign_out)

        div.id = "logout_box"
        div.className = "absolute transition-all bg-gray-800 border border-gray-950 hidden opacity-0 translate-y-full top-8 right-0 p-3 rounded shadow dark:bg-gray-700"
        signin.append(div)
    }
})