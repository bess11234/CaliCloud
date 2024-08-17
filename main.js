import './style.css'
import javascriptLogo from './javascript.svg'
import viteLogo from '/vite.svg'
import { setupCounter } from './counter.js'

document.querySelector("#vitelogo").src = viteLogo
document.querySelector("#javascriptlogo").src = javascriptLogo

setupCounter(document.querySelector('#counter'))
