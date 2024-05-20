<div class="d-flex justify-content-end">
    <div class="xs-panel-nav d-flex d-lg-none justify-content-between py-5 px-15">
        <div class="user-info d-flex align-items-center justify-content-between">
            <div class="user-avatar bg-gray200">
                <img src="<?= $user_avatar; ?>" class="img-cover" alt="<?= $user_name; ?>">
            </div>

            <div class="user-name ml-15">
                <h3 class="font-16 font-weight-bold"><?= $user_name; ?></h3>
            </div>
        </div>

        <button class="sidebar-toggler btn-transparent d-flex flex-column-reverse justify-content-center align-items-center p-5 rounded-sm sidebarNavToggle" type="button">
            <span>Menu</span>
            <i data-feather="menu" width="16" height="16"></i>
        </button>
    </div>

    <div class="panel-sidebar pt-50 pb-25 px-25" id="panelSidebar">
        <button class="btn-transparent panel-sidebar-close sidebarNavToggle">
            <i data-feather="x" width="24" height="24"></i>
        </button>

        <div class="user-info d-flex align-items-center flex-row flex-lg-column justify-content-lg-center">
            <a href="/user/panel" class="user-avatar bg-gray200 mr-2">
                <img src="<?= $user_avatar; ?>" class="img-cover" alt="<?= $user_name; ?>">
            </a>

            <div class="d-flex flex-column align-items-center justify-content-center">
                <a href="/user/panel" class="user-name mt-15">
                    <h3 class="font-16 font-weight-bold text-center"><?= $user_name; ?></h3>
                </a>
            </div>
        </div>

        <div class="d-flex sidebar-user-stats pb-10 ml-20 pb-lg-20 mt-15 mt-lg-30">
            <div class="sidebar-user-stat-item d-flex flex-column">
                <strong class="text-center">0</strong>
                <span class="font-12">Courses</span>
            </div>

            <div class="border-left mx-30"></div>

            <div class="sidebar-user-stat-item d-flex flex-column">
                <strong class="text-center">0</strong>
                <span class="font-12">Following</span>
            </div>
        </div>

        <ul id="panel-sidebar-scroll" class="sidebar-menu pt-10  ">

            <li class="sidenav-item sidenav-item-active">
                <a href="/user/panel" class="d-flex align-items-center">
                    <span class="sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g id="Group_1264" transform="translate(-188.102 -869.102)">
                                <g id="Group_1262">
                                    <g id="speedometer" transform="translate(188.102 869.102)">
                                        <path id="Path_1547" d="M20.484 3.515a12 12 0 0 0-16.97 16.97 12 12 0 0 0 16.97-16.97zM12 22.593A10.594 10.594 0 1 1 22.593 12 10.606 10.606 0 0 1 12 22.593zm0 0" class="cls-1" />
                                        <path id="Path_1548" d="M118.647 321.206a.7.7 0 0 0-.5-.206h-8.094a.7.7 0 0 0-.5.206l-2.228 2.228a.7.7 0 0 0-.012.982 9.357 9.357 0 0 0 13.569 0 .7.7 0 0 0-.012-.982zm-4.544 4.716a7.882 7.882 0 0 1-5.273-2l1.517-1.517h7.512l1.517 1.517a7.882 7.882 0 0 1-5.273 2zm0 0" class="cls-1" transform="translate(-102.104 -305.954)" />
                                        <path id="Path_1549" d="M216.719 120.194a.7.7 0 0 0-.919.38l-1.606 3.876h-.091a2.063 2.063 0 1 0 1.39.541l1.606-3.877a.7.7 0 0 0-.38-.919zm-2.616 6.969a.654.654 0 1 1 .654-.654.655.655 0 0 1-.657.654zm0 0" class="cls-1" transform="translate(-202.104 -114.509)" />
                                        <path id="Path_1550" d="M65.375 56A9.385 9.385 0 0 0 56 65.375a.7.7 0 0 0 .7.7h1.25a.7.7 0 1 0 0-1.406h-.516a7.933 7.933 0 0 1 1.83-4.409l.362.362a.7.7 0 1 0 .994-.994l-.362-.362a7.934 7.934 0 0 1 4.41-1.83v.516a.7.7 0 1 0 1.406 0v-.516a7.934 7.934 0 0 1 4.41 1.83l-.362.362a.7.7 0 0 0 .994.994l.362-.362a7.932 7.932 0 0 1 1.83 4.409H72.8a.7.7 0 0 0 0 1.406h1.25a.7.7 0 0 0 .7-.7A9.385 9.385 0 0 0 65.375 56zm0 0" class="cls-1" transform="translate(-53.376 -53.375)" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Dashboard</span>
                </a>
            </li>


            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#webinarCollapse" role="button" aria-expanded="false" aria-controls="webinarCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g id="Mask_Group_17" clip-path="url(#clip-path)" data-name="Mask Group 17" transform="translate(-25 -410)">
                                <g id="online-class" transform="translate(25 410)">
                                    <path id="Path_153" d="M22.078 12.319a2.112 2.112 0 0 0 1.922-2.1V3.656a2.112 2.112 0 0 0-2.109-2.109h-6.985A2.112 2.112 0 0 0 12.8 3.656v2.766H4.031a2.112 2.112 0 0 0-2.109 2.109v8.438a2.1 2.1 0 0 0 .121.7h-.777A1.267 1.267 0 0 0 0 18.938a3.52 3.52 0 0 0 3.516 3.516h16.968A3.52 3.52 0 0 0 24 18.938a1.267 1.267 0 0 0-1.266-1.266h-.777a2.1 2.1 0 0 0 .121-.7zM14.2 3.656a.7.7 0 0 1 .7-.7h6.984a.7.7 0 0 1 .7.7v6.562a.7.7 0 0 1-.7.7h-6.509a.7.7 0 0 0-.373.107l-1.418.886.589-1.963a.7.7 0 0 0 .03-.2zm6.281 17.391H3.516a2.112 2.112 0 0 1-2.1-1.969h21.173a2.112 2.112 0 0 1-2.105 1.969zM6.7 12.375a.8.8 0 1 1 .8.8.8.8 0 0 1-.8-.8zm-.375 3c0-.424.548-.8 1.172-.8a1.435 1.435 0 0 1 .885.287.692.692 0 0 1 .287.51v2.3H6.328zm3.75 2.3v-2.3a2.074 2.074 0 0 0-.815-1.608l-.036-.027a2.2 2.2 0 1 0-3.455 0 2.073 2.073 0 0 0-.851 1.634v2.3h-.887a.7.7 0 0 1-.7-.7V8.531a.7.7 0 0 1 .7-.7H12.8v1.816l-.559 1.864a1.4 1.4 0 0 0 2.092 1.6l1.247-.779h5.1v4.641a.7.7 0 0 1-.7.7z" class="cls-3" data-name="Path 153" />
                                    <path id="Path_154" d="M19.125 7.922h-1.5a.7.7 0 0 0 0 1.406h1.5a.7.7 0 0 0 0-1.406z" class="cls-3" data-name="Path 154" />
                                    <path id="Path_155" d="M16.5 5.953h3.75a.7.7 0 0 0 0-1.406H16.5a.7.7 0 0 0 0 1.406z" class="cls-3" data-name="Path 155" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Courses</span>
                </a>

                <div class="collapse " id="webinarCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/user/panel/webinars/organization_classes">Organization courses</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/webinars/purchases">My purchases</a>
                        </li>


                        <li class="mt-5 ">
                            <a href="/user/panel/webinars/my-comments">My comments</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/webinars/favorites">Favorites</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/webinars/personal-notes">Course Notes</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#upcomingCoursesCollapse" role="button" aria-expanded="false" aria-controls="upcomingCoursesCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <i data-feather="film" class="img-cover"></i>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Upcoming Courses</span>
                </a>

                <div class="collapse " id="upcomingCoursesCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/user/panel/upcoming_courses/followings">Following courses</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#assignmentCollapse" role="button" aria-expanded="false" aria-controls="assignmentCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-feather">
                            <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L5 10.5V19h8.5z"></path>
                            <line x1="16" y1="8" x2="2" y2="22"></line>
                            <line x1="17.5" y1="15" x2="9" y2="15"></line>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Assignments</span>
                </a>

                <div class="collapse " id="assignmentCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/user/panel/assignments/my-assignments">My Assignments</a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#meetingCollapse" role="button" aria-expanded="false" aria-controls="meetingCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g id="Mask_Group_21" clip-path="url(#clip-path)" data-name="Mask Group 21" transform="translate(-25 -410)">
                                <g id="online-class_1_" data-name="online-class (1)" transform="translate(25 410)">
                                    <path id="Path_170" d="M21.422 0H2.578A2.581 2.581 0 0 0 0 2.578v18.844A2.581 2.581 0 0 0 2.578 24h18.844A2.581 2.581 0 0 0 24 21.422V2.578A2.581 2.581 0 0 0 21.422 0zM1.406 2.578a1.173 1.173 0 0 1 1.172-1.172h18.844a1.173 1.173 0 0 1 1.172 1.172v13.453H1.406zm21.188 18.844a1.173 1.173 0 0 1-1.172 1.172H2.578a1.173 1.173 0 0 1-1.172-1.172v-3.984h21.188z" class="cls-3" data-name="Path 170" />
                                    <path id="Path_171" d="M3.563 20.719h9.609v.234a.7.7 0 0 0 1.406 0v-.234h5.859a.7.7 0 0 0 0-1.406h-5.859v-.234a.7.7 0 0 0-1.406 0v.234H3.563a.7.7 0 0 0 0 1.406z" class="cls-3" data-name="Path 171" />
                                    <path id="Path_172" d="M20.167 6.122L12.2 3.779a.7.7 0 0 0-.4 0L3.833 6.122a.7.7 0 0 0 0 1.349l2.777.817v3.665a.7.7 0 0 0 .7.7h9.375a.7.7 0 0 0 .7-.7V8.288l1.875-.551v3.279a.7.7 0 0 0 1.406 0V6.8a.7.7 0 0 0-.499-.678zm-4.183 5.128H8.016V8.7L11.8 9.815a.7.7 0 0 0 .4 0L15.984 8.7zM12 8.408L6.523 6.8 12 5.186 17.477 6.8z" class="cls-3" data-name="Path 172" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Meetings</span>
                </a>

                <div class="collapse " id="meetingCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/user/panel/meetings/reservation">My reservations</a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#quizzesCollapse" role="button" aria-expanded="false" aria-controls="quizzesCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g id="Mask_Group_18" clip-path="url(#clip-path)" data-name="Mask Group 18" transform="translate(-25 -410)">
                                <g id="task" transform="translate(25 410)">
                                    <path id="Path_156" d="M8.227 6.8h-3.75a.7.7 0 0 0 0 1.406h3.75a.7.7 0 0 0 0-1.406z" class="cls-3" data-name="Path 156" />
                                    <path id="Path_157" d="M8.227 10.547h-3.75a.7.7 0 0 0 0 1.406h3.75a.7.7 0 0 0 0-1.406z" class="cls-3" data-name="Path 157" />
                                    <path id="Path_158" d="M8.227 14.3h-3.75a.7.7 0 0 0 0 1.406h3.75a.7.7 0 0 0 0-1.406z" class="cls-3" data-name="Path 158" />
                                    <path id="Path_159" d="M18.3 12.887V6.468a3.5 3.5 0 0 0-1-2.462l-2.853-2.95A3.538 3.538 0 0 0 11.934 0H2.883a2.112 2.112 0 0 0-2.11 2.109v18.235a2.112 2.112 0 0 0 2.109 2.109H13.75a5.589 5.589 0 1 0 4.55-9.566zM2.18 20.344V2.109a.7.7 0 0 1 .7-.7h9.051a2.124 2.124 0 0 1 1.5.629l2.852 2.95a2.1 2.1 0 0 1 .617 1.48v6.42a5.576 5.576 0 0 0-4.217 8.159h-9.8a.7.7 0 0 1-.7-.7zm15.42 2.25a4.172 4.172 0 1 1 4.219-4.172 4.177 4.177 0 0 1-4.219 4.172z" class="cls-3" data-name="Path 159" />
                                    <path id="Path_160" d="M19.224 16.757a.7.7 0 0 0-.99.09l-1.187 1.424-.269-.538a.7.7 0 0 0-1.258.629l.75 1.5a.7.7 0 0 0 .548.384.716.716 0 0 0 .081 0 .7.7 0 0 0 .54-.253l1.875-2.25a.7.7 0 0 0-.09-.986z" class="cls-3" data-name="Path 160" />
                                    <path id="Path_161" d="M11.977 8.2h.75a.7.7 0 0 0 0-1.406h-.75a.7.7 0 0 0 0 1.406z" class="cls-3" data-name="Path 161" />
                                    <path id="Path_162" d="M13.43 11.25a.7.7 0 0 0-.7-.7h-.75a.7.7 0 0 0 0 1.406h.75a.7.7 0 0 0 .7-.706z" class="cls-3" data-name="Path 162" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Quizzes</span>
                </a>

                <div class="collapse " id="quizzesCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/user/panel/quizzes/my-results">My results</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/quizzes/opens">Not Participated</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#certificatesCollapse" role="button" aria-expanded="false" aria-controls="certificatesCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <defs>
                                <clipPath id="clip-path">
                                    <path id="Rectangle_204" fill="#1f3b64" stroke="#707070" d="M0 0H24V24H0z" data-name="Rectangle 204" transform="translate(25 410)" />
                                </clipPath>
                            </defs>
                            <g id="Mask_Group_19" clip-path="url(#clip-path)" data-name="Mask Group 19" transform="translate(-25 -410)">
                                <g id="reward" transform="translate(25 410)">
                                    <g id="Group_183" data-name="Group 183">
                                        <g id="Group_182" data-name="Group 182">
                                            <path id="Path_163" d="M16.423 5.789a7.668 7.668 0 0 0-1.478-.824l-.59 1.406a6.165 6.165 0 0 1 1.181.659z" class="cls-3" data-name="Path 163" />
                                            <path id="Path_164" d="M18.665 8.291a7.619 7.619 0 0 0-.982-1.373l-1.136 1.018a6.177 6.177 0 0 1 .786 1.1z" class="cls-3" data-name="Path 164" />
                                            <path id="Path_165" d="M17.855 10.28a6.092 6.092 0 1 1-4.794-4.29l.263-1.5A7.81 7.81 0 0 0 12 4.374a7.618 7.618 0 1 0 7.321 5.479z" class="cls-3" data-name="Path 165" />
                                            <path id="Path_166" d="M24 12l-1.954-2.692L22.393 6l-3.038-1.355L18 1.607l-3.308.347L12 0 9.308 1.954 6 1.607 4.645 4.645 1.607 6l.347 3.308L0 12l1.954 2.692L1.607 18l3.038 1.354L6 22.393l3.308-.347L12 24l2.692-1.954 3.308.347 1.354-3.038L22.393 18l-.347-3.308zm-5.8 6.2l-1.145 2.56-2.785-.3L12 22.116l-2.27-1.651-2.788.292L5.8 18.2l-2.563-1.148.3-2.782L1.884 12l1.651-2.27-.3-2.788L5.8 5.8l1.145-2.563 2.788.292L12 1.884l2.27 1.651 2.788-.292L18.2 5.8l2.562 1.144-.3 2.782L22.116 12l-1.651 2.27.292 2.788z" class="cls-3" data-name="Path 166" />
                                            <path id="Path_167" d="M8.726 11.461l-1.078 1.078 2.827 2.827 5.115-5.115-1.079-1.078-4.036 4.037z" class="cls-3" data-name="Path 167" />
                                        </g>
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Certificates</span>
                </a>

                <div class="collapse " id="certificatesCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/user/panel/certificates/achievements">Achievements</a>
                        </li>

                        <li class="mt-5">
                            <a href="/certificate_validation">Certificate Validation</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/certificates/webinars">Completion Certificates</a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#storeCollapse" role="button" aria-expanded="false" aria-controls="storeCollapse">
                    <span class="sidenav-item-icon assign-fill mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve">
                            <g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <path d="m481 422.241v-218.276c17.79-9.12 30-27.637 30-48.965v-40c0-2.719-.739-5.386-2.138-7.717l-60-100c-2.711-4.518-7.593-7.283-12.862-7.283h-360c-5.269 0-10.151 2.765-12.862 7.283l-60 100c-1.399 2.331-2.138 4.998-2.138 7.717v40c0 21.327 12.21 39.845 30 48.965v218.276c-17.977 5.901-31 22.833-31 42.759v32c0 8.284 6.716 15 15 15h482c8.284 0 15-6.716 15-15v-32c0-19.926-13.023-36.858-31-42.759zm-90-2.241h-90v-150h90zm15-180h-120c-8.284 0-15 6.716-15 15v165h-210v-210.238c13.745-1.245 26.039-7.567 35-17.072 10.036 10.645 24.25 17.31 40 17.31s29.964-6.665 40-17.31c10.036 10.645 24.25 17.31 40 17.31s29.964-6.665 40-17.31c10.036 10.645 24.25 17.31 40 17.31s29.964-6.665 40-17.31c10.036 10.645 24.25 17.31 40 17.31s29.964-6.665 40-17.31c8.961 9.505 21.255 15.827 35 17.072v210.238h-30v-165c0-8.284-6.716-15-15-15zm-375-110h50v25c0 13.785-11.215 25-25 25s-25-11.215-25-25zm370 25c0 13.785-11.215 25-25 25s-25-11.215-25-25v-25h50zm-80 0c0 13.785-11.215 25-25 25s-25-11.215-25-25v-25h50zm-80 0c0 13.785-11.215 25-25 25s-25-11.215-25-25v-25h50zm-80 0c0 13.785-11.215 25-25 25s-25-11.215-25-25v-25h50zm295 25c-13.785 0-25-11.215-25-25v-25h50v25c0 13.785-11.215 25-25 25zm-28.493-150 42 70h-43.352l-28-70zm-61.663 0 28 70h-45.548l-14-70zm-48.141 70h-46.703v-70h32.703zm-109.406-70h32.703v70h-46.703zm-44.594 70h-45.548l28-70h31.548zm-79.21-70h29.352l-28 70h-43.352zm397.507 452h-452v-17c0-8.271 6.729-15 15-15h1 421c8.271 0 15 6.729 15 15z" fill="#000000" data-original="#000000"></path>
                                    <path d="m226 240h-120c-8.284 0-15 6.716-15 15v120c0 8.284 6.716 15 15 15h120c8.284 0 15-6.716 15-15v-120c0-8.284-6.716-15-15-15zm-15 120h-90v-90h90z" fill="#000000" data-original="#000000"></path>
                                    <circle cx="336" cy="345" r="15" fill="#000000" data-original="#000000"></circle>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Store</span>
                </a>

                <div class="collapse " id="storeCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/user/panel/store/purchases">My purchases</a>
                        </li>


                        <li class="mt-5 ">
                            <a href="/user/panel/store/products/my-comments">My comments</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#financialCollapse" role="button" aria-expanded="false" aria-controls="financialCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <defs>
                                <clipPath id="clip-path">
                                    <path id="Rectangle_204" fill="#1f3b64" stroke="#707070" d="M0 0H24V24H0z" data-name="Rectangle 204" transform="translate(25 410)" />
                                </clipPath>
                            </defs>
                            <g id="Mask_Group_20" clip-path="url(#clip-path)" data-name="Mask Group 20" transform="translate(-25 -410)">
                                <g id="money_1_" data-name="money (1)" transform="translate(25 410)">
                                    <path id="Path_168" d="M21.176 18.446v-3.622a9.191 9.191 0 0 0-6.061-8.631 2.112 2.112 0 0 0-.577-3.043A3.514 3.514 0 0 0 15.527.7a.7.7 0 0 0-.7-.7H9.176a.7.7 0 0 0-.7.7 3.514 3.514 0 0 0 .99 2.447 2.112 2.112 0 0 0-.577 3.043 9.191 9.191 0 0 0-6.061 8.631v3.622A2.821 2.821 0 0 0 3.527 24h16.946a2.821 2.821 0 0 0 .7-5.554zM14 1.406a2.121 2.121 0 0 1-4 0zm-3.412 4.242a.709.709 0 0 1 0-1.418h2.824a.709.709 0 0 1 0 1.418zm9.885 16.945H3.527a1.415 1.415 0 1 1 0-2.83.7.7 0 0 0 .7-.7v-4.239a7.77 7.77 0 1 1 15.539 0v4.236a.7.7 0 0 0 .7.7 1.415 1.415 0 1 1 0 2.83z" class="cls-3" data-name="Path 168" />
                                    <path id="Path_169" d="M12 12.7h1.412a.7.7 0 0 0 0-1.406H12.7v-.709a.7.7 0 0 0-1.406 0v.83a2.115 2.115 0 0 0 .7 4.11.709.709 0 0 1 0 1.418h-1.406a.7.7 0 0 0 0 1.406h.712v.709a.7.7 0 0 0 1.406 0v-.83a2.115 2.115 0 0 0-.7-4.11A.709.709 0 0 1 12 12.7z" class="cls-3" data-name="Path 169" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Financial</span>
                </a>

                <div class="collapse " id="financialCollapse">
                    <ul class="sidenav-item-collapse">


                        <li class="mt-5 ">
                            <a href="/user/panel/financial/summary">Financial summary</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/financial/payout">Payout</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/financial/account">Charge account</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/financial/subscribes">Subscribe</a>
                        </li>


                        <li class="mt-5 ">
                            <a href="/user/panel/financial/installments">Installments</a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#supportCollapse" role="button" aria-expanded="false" aria-controls="supportCollapse">
                    <span class="sidenav-item-icon assign-fill mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve">
                            <g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="M437.02,74.98C388.667,26.629,324.38,0,256,0S123.333,26.629,74.98,74.98C26.629,123.333,0,187.62,0,256    s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.98    C485.371,388.667,512,324.38,512,256S485.371,123.333,437.02,74.98z M256,30c56.921,0,108.988,21.161,148.767,56.019    l-69.813,69.813c-21.736-17.169-49.168-27.43-78.954-27.43c-29.785,0-57.218,10.261-78.953,27.43l-69.813-69.813    C147.012,51.161,199.079,30,256,30z M353.598,256c0,53.816-43.782,97.598-97.598,97.598c-53.816,0-97.598-43.782-97.598-97.598    c0-53.816,43.782-97.598,97.598-97.598C309.816,158.402,353.598,202.184,353.598,256z M30,256    c0-56.922,21.162-108.989,56.021-148.768l69.813,69.813c-17.17,21.736-27.432,49.169-27.432,78.956    c0,29.785,10.261,57.218,27.43,78.954l-69.813,69.813C51.161,364.988,30,312.921,30,256z M256,482    c-56.922,0-108.989-21.162-148.769-56.021l69.813-69.813c21.736,17.17,49.169,27.431,78.955,27.431s57.219-10.261,78.956-27.432    l69.813,69.813C364.989,460.838,312.922,482,256,482z M425.981,404.766l-69.813-69.813c17.169-21.736,27.43-49.168,27.43-78.953    c0-29.786-10.261-57.219-27.431-78.955l69.813-69.813C460.838,147.011,482,199.078,482,256    C482,312.921,460.839,364.988,425.981,404.766z" fill="#000000" data-original="#000000"></path>
                                    </g>
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Support</span>
                </a>

                <div class="collapse " id="supportCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/user/panel/support/new">New</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/support">Courses support</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/support/tickets">Tickets</a>
                        </li>

                    </ul>
                </div>
            </li>


            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#marketingCollapse" role="button" aria-expanded="false" aria-controls="marketingCollapse">
                    <span class="sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g id="Group_1261" transform="translate(-180 -776.999)">
                                <g id="price-tag" transform="translate(180 776.999)">
                                    <path id="Path_1553" d="M175.692 124l3.315-9.944a.7.7 0 0 0-1.334-.445l-3.315 9.944a.7.7 0 1 0 1.334.445z" class="cls-1" transform="translate(-166.15 -107.828)" />
                                    <path id="Path_1554" d="M266.642 193.422a2.109 2.109 0 1 0-2.109-2.109 2.112 2.112 0 0 0 2.109 2.109zm0-2.813a.7.7 0 1 1-.7.7.7.7 0 0 1 .7-.7z" class="cls-1" transform="translate(-252.133 -180.334)" />
                                    <path id="Path_1555" d="M96.936 189.2a2.109 2.109 0 1 0 2.109 2.109 2.112 2.112 0 0 0-2.109-2.109zm0 2.813a.7.7 0 1 1 .7-.7.7.7 0 0 1-.7.703z" class="cls-1" transform="translate(-90.382 -180.334)" />
                                    <path id="Path_1556" d="M23.86 8.719L21.408 5.45l.1-.67a.7.7 0 0 0-.2-.6l-1.495-1.488L21.3 1.2a.7.7 0 0 0-.99-.994L18.819 1.7 17.327.206a.7.7 0 0 0-.6-.2L9.77 1a.7.7 0 0 0-.4.2L.754 9.818a2.581 2.581 0 0 0 0 3.646l7.292 7.292a2.572 2.572 0 0 0 .485.381v.285A2.581 2.581 0 0 0 11.11 24h10.312A2.581 2.581 0 0 0 24 21.422V9.141a.7.7 0 0 0-.141-.422zM1.748 12.47a1.173 1.173 0 0 1 0-1.657L10.2 2.361l6.381-.911 1.243 1.243-.994.994-.5-.5a.7.7 0 1 0-.994.994l1.989 1.989a.7.7 0 0 0 .994-.994l-.5-.5.994-.994 1.249 1.248-.912 6.38-8.45 8.452a1.172 1.172 0 0 1-1.657 0zm20.846 8.952a1.173 1.173 0 0 1-1.172 1.172H11.11a1.173 1.173 0 0 1-1.168-1.085 2.568 2.568 0 0 0 1.751-.752l8.618-8.618a.7.7 0 0 0 .2-.4l.617-4.322 1.468 1.957z" class="cls-1" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Marketing</span>
                </a>

                <div class="collapse " id="marketingCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/user/panel/marketing/affiliates">Affiliate</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/marketing/registration_bonus">Registration Bonus</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/marketing/discounts">Coupons</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/marketing/discounts/new">New Coupon</a>
                        </li>
                    </ul>
                </div>
            </li>


            <li class="sidenav-item ">
                <a class="d-flex align-items-center" data-toggle="collapse" href="#forumsCollapse" role="button" aria-expanded="false" aria-controls="forumsCollapse">
                    <span class="sidenav-item-icon assign-fill mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 511.999 511.999" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                            <g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="M510.156,401.843L480.419,315.3c14.334-29.302,21.909-61.89,21.96-94.679c0.088-57.013-21.97-110.92-62.112-151.79    C400.117,27.953,346.615,4.942,289.615,4.039C230.51,3.105,174.954,25.587,133.187,67.353    c-40.274,40.273-62.612,93.366-63.319,150.102C30.174,247.341,6.745,293.936,6.822,343.705    c0.037,23.29,5.279,46.441,15.212,67.376L1.551,470.689c-3.521,10.247-0.949,21.373,6.713,29.035    c5.392,5.393,12.501,8.264,19.812,8.264c3.076,0,6.188-0.508,9.223-1.551l59.609-20.483c20.935,9.933,44.086,15.175,67.376,15.212    c0.084,0,0.164,0,0.248,0c50.51-0.002,97.46-24.035,127.237-64.702c30.987-0.816,61.646-8.317,89.363-21.876l86.544,29.738    c3.606,1.239,7.304,1.843,10.959,1.843c8.688,0,17.136-3.412,23.545-9.822C511.284,427.242,514.34,414.021,510.156,401.843z     M164.53,470.69c-0.065,0-0.134,0-0.199,0c-20.614-0.031-41.085-5.113-59.196-14.695c-3.724-1.969-8.096-2.31-12.078-0.942    l-61.123,21.003l21.003-61.122c1.368-3.983,1.028-8.355-0.942-12.078c-9.582-18.112-14.664-38.582-14.696-59.197    c-0.051-33.159,12.848-64.588,35.405-88.122c7.368,44.916,28.775,86.306,61.957,118.898    c32.937,32.351,74.339,52.949,119.011,59.683C230.084,457.367,198.288,470.69,164.53,470.69z M480.628,414.797    c-0.867,0.867-1.895,1.103-3.051,0.705l-92.648-31.836c-1.609-0.553-3.283-0.827-4.951-0.827c-2.459,0-4.909,0.595-7.126,1.769    c-26.453,13.994-56.345,21.416-86.447,21.462c-0.099,0-0.189,0-0.288,0c-100.863,0-184.176-81.934-185.774-182.773    c-0.805-50.785,18.513-98.514,54.394-134.395c35.881-35.881,83.618-55.192,134.396-54.392    c100.936,1.601,182.926,85.068,182.77,186.063c-0.047,30.102-7.468,59.995-21.461,86.446c-1.97,3.723-2.31,8.095-0.942,12.078    l31.835,92.648C481.732,412.905,481.494,413.932,480.628,414.797z" fill="#000000" data-original="#000000"></path>
                                    </g>
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="M376.892,139.512h-181.56c-8.416,0-15.238,6.823-15.238,15.238c0,8.416,6.823,15.238,15.238,15.238h181.56    c8.416,0,15.238-6.823,15.238-15.238C392.13,146.335,385.308,139.512,376.892,139.512z" fill="#000000" data-original="#000000"></path>
                                    </g>
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="M376.892,202.183h-181.56c-8.416,0-15.238,6.823-15.238,15.238s6.823,15.238,15.238,15.238h181.56    c8.416,0,15.238-6.823,15.238-15.238S385.308,202.183,376.892,202.183z" fill="#000000" data-original="#000000"></path>
                                    </g>
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="M307.004,264.852H195.331c-8.416,0-15.238,6.823-15.238,15.238c0,8.416,6.823,15.238,15.238,15.238h111.672    c8.416,0,15.238-6.823,15.238-15.238C322.241,271.675,315.42,264.852,307.004,264.852z" fill="#000000" data-original="#000000"></path>
                                    </g>
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Forums</span>
                </a>

                <div class="collapse " id="forumsCollapse">
                    <ul class="sidenav-item-collapse">

                        <li class="mt-5 ">
                            <a href="/forums/create-topic">New Topic</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/forums/topics">My Topics</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/forums/posts">My Posts</a>
                        </li>

                        <li class="mt-5 ">
                            <a href="/user/panel/forums/bookmarks">Bookmarks</a>
                        </li>

                    </ul>
                </div>
            </li>





            <li class="sidenav-item ">
                <a href="/user/panel/rewards" class="d-flex align-items-center">
                    <span class="sidenav-item-icon assign-strock mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#1f3b64" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Reward Points</span>
                </a>
            </li>


            <li class="sidenav-item ">
                <a href="/user/panel/notifications" class="d-flex align-items-center">
                    <span class="sidenav-notification-icon sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="19.5" height="20.496" viewBox="0 0 19.5 20.496">
                            <g id="Group_1266" transform="translate(-207.65 -516.252)">
                                <g id="Group_1265">
                                    <g id="Icon_feather-bell" transform="translate(205.4 515.002)">
                                        <path id="Path_175" d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" class="cls-1" />
                                        <path id="Path_176" d="M13.73 21a2 2 0 0 1-3.46 0" class="cls-1" transform="translate(0 -1)" />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Notifications</span>
                </a>
            </li>

            <li class="sidenav-item ">
                <a href="/user/panel/setting" class="d-flex align-items-center">
                    <span class="sidenav-setting-icon sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g id="Mask_Group_24" clip-path="url(#clip-path)" data-name="Mask Group 24" transform="translate(-25 -410)">
                                <g id="settings" transform="translate(25 410)">
                                    <path id="Path_177" d="M12.753 24h-1.506a2.212 2.212 0 0 1-2.209-2.209v-.51a9.689 9.689 0 0 1-1.5-.625l-.361.361a2.209 2.209 0 0 1-3.125 0l-1.07-1.064a2.209 2.209 0 0 1 0-3.125l.361-.361a9.69 9.69 0 0 1-.625-1.5h-.51A2.212 2.212 0 0 1 0 12.753v-1.506a2.212 2.212 0 0 1 2.209-2.209h.51a9.692 9.692 0 0 1 .625-1.5l-.361-.361a2.209 2.209 0 0 1 0-3.125l1.064-1.07a2.209 2.209 0 0 1 3.125 0l.361.361a9.7 9.7 0 0 1 1.5-.625v-.51A2.212 2.212 0 0 1 11.247 0h1.506a2.212 2.212 0 0 1 2.209 2.209v.51a9.689 9.689 0 0 1 1.5.625l.361-.361a2.209 2.209 0 0 1 3.125 0l1.065 1.065a2.209 2.209 0 0 1 0 3.125l-.361.361a9.69 9.69 0 0 1 .625 1.5h.51A2.212 2.212 0 0 1 24 11.247v1.506a2.212 2.212 0 0 1-2.209 2.209h-.51a9.692 9.692 0 0 1-.625 1.5l.361.361a2.209 2.209 0 0 1 0 3.125l-1.065 1.065a2.209 2.209 0 0 1-3.125 0l-.361-.361a9.7 9.7 0 0 1-1.5.625v.51A2.212 2.212 0 0 1 12.753 24zm-4.985-4.82a8.288 8.288 0 0 0 2.148.892.7.7 0 0 1 .527.681v1.038a.8.8 0 0 0 .8.8h1.506a.8.8 0 0 0 .8-.8v-1.039a.7.7 0 0 1 .527-.681 8.288 8.288 0 0 0 2.148-.892.7.7 0 0 1 .855.108l.735.735a.8.8 0 0 0 1.135 0l1.065-1.065a.8.8 0 0 0 0-1.136l-.736-.736a.7.7 0 0 1-.108-.855 8.287 8.287 0 0 0 .892-2.148.7.7 0 0 1 .681-.527h1.038a.8.8 0 0 0 .8-.8v-1.508a.8.8 0 0 0-.8-.8h-1.028a.7.7 0 0 1-.681-.527 8.288 8.288 0 0 0-.892-2.148.7.7 0 0 1 .108-.855l.735-.735a.8.8 0 0 0 0-1.136l-1.065-1.069a.8.8 0 0 0-1.136 0l-.736.736a.7.7 0 0 1-.855.108 8.288 8.288 0 0 0-2.148-.892.7.7 0 0 1-.527-.681V2.209a.8.8 0 0 0-.8-.8h-1.509a.8.8 0 0 0-.8.8v1.039a.7.7 0 0 1-.527.681 8.288 8.288 0 0 0-2.148.892.7.7 0 0 1-.855-.108l-.735-.735a.8.8 0 0 0-1.135 0l-1.07 1.064a.8.8 0 0 0 0 1.136l.736.736a.7.7 0 0 1 .108.855 8.287 8.287 0 0 0-.892 2.148.7.7 0 0 1-.681.527H2.209a.8.8 0 0 0-.8.8v1.506a.8.8 0 0 0 .8.8h1.039a.7.7 0 0 1 .681.527 8.288 8.288 0 0 0 .892 2.148.7.7 0 0 1-.108.855l-.735.735a.8.8 0 0 0 0 1.136l1.065 1.065a.8.8 0 0 0 1.136 0l.736-.736a.706.706 0 0 1 .855-.108z" class="cls-3" data-name="Path 177" />
                                    <path id="Path_178" d="M12 17.222A5.222 5.222 0 1 1 17.222 12 5.228 5.228 0 0 1 12 17.222zm0-9.038A3.816 3.816 0 1 0 15.816 12 3.82 3.82 0 0 0 12 8.184z" class="cls-3" data-name="Path 178" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Settings</span>
                </a>
            </li>


            <li class="sidenav-item">
                <a href="/logout" class="d-flex align-items-center">
                    <span class="sidenav-logout-icon sidenav-item-icon mr-10">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23.999" height="23.999" viewBox="0 0 23.999 23.999">
                            <g id="Group_1263" transform="translate(-161.102 -869.102)">
                                <g id="power-button" transform="translate(161.102 869.102)">
                                    <path id="Path_1541" d="M20.473 3.526a11.984 11.984 0 1 0 0 16.947 11.945 11.945 0 0 0 0-16.947zM12 22.591A10.591 10.591 0 1 1 22.591 12 10.6 10.6 0 0 1 12 22.591z" class="cls-1" />
                                    <path id="Path_1542" d="M153.7 168.953a.7.7 0 0 0-.93 1.047 3.8 3.8 0 1 1-5.016-.019.7.7 0 1 0-.925-1.058 5.2 5.2 0 1 0 6.875.025z" class="cls-1" transform="translate(-138.252 -160.845)" />
                                    <path id="Path_1543" d="M241.753 126.205a.7.7 0 0 0 .7-.7v-3.749a.7.7 0 1 0-1.406 0v3.744a.7.7 0 0 0 .706.705z" class="cls-1" transform="translate(-229.754 -115.378)" />
                                </g>
                            </g>
                        </svg>
                    </span>
                    <span class="font-14 text-dark-blue font-weight-500">Log out</span>
                </a>
            </li>

        </ul>

        <div class="sidebar-create-class d-none d-md-block">
            <a href="/classes?sort=newest" class="sidebar-create-class-btn d-block text-right p-5">
                <img src="/store/1/sidebar-user.png" alt="">
            </a>
        </div>
    </div>