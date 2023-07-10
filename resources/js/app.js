import './bootstrap';

import Alpine from 'alpinejs';
import { Datepicker, Input, initTE, Collapse, Ripple } from "tw-elements";
initTE({ Datepicker, Input, Collapse, Ripple });

window.Alpine = Alpine;

Alpine.start();
