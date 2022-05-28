<template>
    <aside class="sidebar" data-trigger="scrollbar">
        <div class="sidebar--profile">
            <div class="profile--img">
                <a href="profile.html">
                    <img src="assets/img/avatars/01_80x80.png" alt="" class="rounded-circle">
                </a>
            </div>

            <div class="profile--name">
                <a href="profile.html" class="btn-link">Henry Foster</a>
            </div>

            <div class="profile--nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a href="profile.html" class="nav-link" title="User Profile">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="lock-screen.html" class="nav-link" title="Lock Screen">
                            <i class="fa fa-lock"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="mailbox_inbox.html" class="nav-link" title="Messages">
                            <i class="fa fa-envelope"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" title="Logout">
                            <i class="fa fa-sign-out-alt"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sidebar--nav">
            <ul>
                <li>
                    <ul>
                        <li :class="{active:$route.name=='Dashboard'}">
                            <router-link :to="{name:'Dashboard'}">
                                <i class="fa fa-home"></i>
                                <span>Dashboard</span>
                            </router-link>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-newspaper"></i>
                                <span>Berita</span>
                            </a>

                            <ul>
                                <li :class="{active:$route.name=='ListNews'}">
                                    <router-link :to="{name:'ListNews'}">
                                        <i class="fa fa-list"></i>
                                        <span>List Berita</span>
                                    </router-link>
                                </li>
                                <li :class="{active:$route.name=='CreateNews'}">
                                    <router-link :to="{name:'CreateNews'}">
                                        <i class="fa fa-plus"></i>
                                        <span>Tambah Berita</span>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-newspaper"></i>
                                <span>Link Terkait</span>
                            </a>

                            <ul>
                                <li :class="{active:$route.name=='ListRelatedLink'}">
                                    <router-link :to="{name:'ListRelatedLink'}">
                                        <i class="fa fa-list"></i>
                                        <span>List Link Terkait</span>
                                    </router-link>
                                </li>
                                <li :class="{active:$route.name=='CreateRelatedLink'}">
                                    <router-link :to="{name:'CreateRelatedLink'}">
                                        <i class="fa fa-plus"></i>
                                        <span>Tambah Link Terkait</span>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- <li>
                    <a href="#">Layouts</a>

                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa fa-th"></i>
                                <span>Page Layouts</span>
                            </a>

                            <ul>
                                <li><a href="blank.html">Blank Page</a></li>
                                <li><a href="page-light.html">Page Light</a></li>
                                <li><a href="sidebar-light.html">Sidebar Light</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-th-list"></i>
                                <span>Footers</span>
                            </a>

                            <ul>
                                <li><a href="footer-light.html">Footer Light</a></li>
                                <li><a href="footer-dark.html">Footer Dark</a></li>
                                <li><a href="footer-transparent.html">Footer Transparent</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">Components</a>

                    <ul>
                        <li>
                            <a href="#">
                                <i class="far fa-newspaper"></i>
                                <span>UI Elements</span>
                            </a>

                            <ul>
                                <li><a href="buttons.html">Buttons</a></li>
                                <li><a href="pagination.html">Pagination</a></li>
                                <li><a href="progress-bars.html">Progress Bars</a></li>
                                <li><a href="tabs-accordions.html">Tabs &amp; Accordions</a></li>
                                <li><a href="modals.html">Modals</a></li>
                                <li><a href="ui-slider.html">UI Slider</a></li>
                                <li><a href="sweet-alerts.html">Sweet Alerts</a></li>
                                <li><a href="timeline.html">Timeline</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fab fa-wpforms"></i>
                                <span>Form</span>
                            </a>

                            <ul>
                                <li><a href="form-elements.html">Form Elements</a></li>
                                <li><a href="form-wizard.html">Form Wizard</a></li>
                                <li><a href="dropzone.html">Dropzone</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">Apps and Charts</a>

                    <ul>
                        <li>
                            <a href="#">
                                <i class="far fa-envelope"></i>
                                <span>Mailbox</span>
                            </a>

                            <ul>
                                <li><a href="mailbox_inbox.html">Inbox</a></li>
                                <li><a href="mailbox_compose.html">Compose</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="calendar.html">
                                <i class="far fa-calendar-alt"></i>
                                <span>Calendar</span>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <i class="far fa-comments"></i>
                                <span>Chat</span>
                            </a>
                        </li>
                        <li>
                            <a href="contacts.html">
                                <i class="far fa-address-book"></i>
                                <span>Contacts</span>
                            </a>
                        </li>
                        <li>
                            <a href="notes.html">
                                <i class="far fa-sticky-note"></i>
                                <span>Notes</span>
                            </a>
                        </li>
                        <li>
                            <a href="todo-list.html">
                                <i class="fa fa-tasks"></i>
                                <span>Todo List</span>
                            </a>
                        </li>
                        <li>
                            <a href="search-results.html">
                                <i class="fa fa-search"></i>
                                <span>Search Results</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">Extra</a>

                    <ul>
                        <li>
                            <a href="#">
                                <i class="fa fa-file"></i>
                                <span>Extra Pages</span>
                            </a>

                            <ul>
                                <li><a href="pricing-tables.html">Pricing Tables</a></li>
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="invoice.html">Invoice</a></li>
                                <li><a href="login.html">Login</a></li>
                                <li><a href="register.html">Register</a></li>
                                <li><a href="forgot-password.html">Forgot Password</a></li>
                                <li><a href="lock-screen.html">Lock Screen</a></li>
                                <li><a href="404.html">404 Error</a></li>
                                <li><a href="500.html">500 Error</a></li>
                                <li><a href="maintenance.html">Maintenance</a></li>
                                <li><a href="coming-soon.html">Coming Soon</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> -->
            </ul>
        </div>
        <!-- <div class="sidebar--widgets">
            <div class="widget">
                <h3 class="h6 widget--title">Information Summary</h3>
                <div class="summary--widget">
                    <div class="summary--item">
                        <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#2bb3c0">5,6,7,9,15,5,6,7,9,11,7,9,11,7,9,9,3,2</p>

                        <p class="summary--title">Daily Traffic</p>
                        <p class="summary--stats">307.512</p>
                    </div>

                    <div class="summary--item">
                        <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#e16123">2,3,7,7,9,11,9,7,9,11,9,7,5,4,9,7,5,4</p>

                        <p class="summary--title">Average Usage</p>
                        <p class="summary--stats">2,371,527</p>
                    </div>

                    <div class="summary--item">
                        <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#cccccc">5,6,7,9,15,5,6,7,9,11,7,9,11,7,9,9,3,2</p>

                        <p class="summary--title">Disk Usage</p>
                        <p class="summary--stats">37.5%</p>
                    </div>

                    <div class="summary--item">
                        <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#009378">2,3,7,7,9,11,9,7,9,11,9,7,5,4,9,7,5,4</p>

                        <p class="summary--title">CPU Usage</p>
                        <p class="summary--stats">37.05-32</p>
                    </div>
                    
                    <div class="summary--item">
                        <p class="summary--chart" data-trigger="sparkline" data-type="bar" data-width="5" data-height="38" data-color="#ff4040">5,6,7,9,15,5,6,7,9,11,7,9,11,7,9,9,3,2</p>

                        <p class="summary--title">Memory Usage</p>
                        <p class="summary--stats">37.05%</p>
                    </div>
                </div>
            </div>
        </div> -->
    </aside>
</template>