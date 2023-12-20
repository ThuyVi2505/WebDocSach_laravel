<!-- header -->
<div class="p-3 text-center bg-white navbar-1">
    <div class="container">
        <div class="row">
            <!-- Left elements -->
            <div class="col-lg-3 col-md-12 col-12 mb-lg-0 mb-3 d-flex justify-content-center justify-content-md-start align-items-center">
                <a href="{{route('home')}}" class="ms-md-2">
                    <img src="{{asset('assets\images\logos\logo-bookonline.png')}}" height="30px" />
                </a>
            </div>
            <!-- Left elements -->

            <!-- cent elements -->
            <div class="col-lg-6 col-md-10 col-8 align-middle">
                <style>
                    #result {
                        border-bottom: none;
                        top: 100%;
                        left: 0;
                        right: 0;
                        border: solid 2px darkcyan;
                        position: absolute;
                        z-index: 9999;
                        padding: 10px;
                        max-height: 400px;
                        /* Set the maximum height for the results */
                        overflow-y: auto;
                    }

                    #result .item:hover {
                        background: #DBDAD9;
                    }
                </style>
                <form>
                    <div class="input-group w-auto my-auto rounded" style="border: solid 2px darkcyan;background:darkcyan;position:relative;">
                        <input id="search-book" type="text" class="form-control border-0" placeholder="Nhập từ khóa để tìm kiếm sách..." />
                        <span class="input-group-text border-0 rounded" style="background: darkcyan;"><i class="fas fa-search text-white"></i>
                        </span>
                        <ul id="result" class="bg-white w-auto my-auto list-group list-group-flush">

                        </ul>
                    </div>
                </form>
                <script type="text/javascript">
                    $(document).ready(function() {
                        const searchBook = $('#search-book');
                        const searchResults = $('#result');

                        searchResults.css('display', 'none');
                        searchBook.on('focus', function() {
                            if (searchBook.val() != '') {
                                searchResults.css('display', 'block')
                            } else {
                                searchResults.css('display', 'none');
                            }

                        })
                        searchBook.on('keyup', function() {
                            searchResults.html('')
                            var search = $(this).val();
                            if (search != '') {
                                var regex = new RegExp(search, "i");
                                $count = 0;
                                $.getJSON('/json_book/book.json', function(data) {

                                    $.each(data, function(key, value) {
                                        if (value.book_name.search(regex) != -1) {
                                            $count++;
                                            searchResults.css('display', 'block');
                                            // li
                                            const child = document.createElement('li');
                                            child.className = 'list-group-item item';
                                            // a
                                            const a = document.createElement('a');
                                            a.href = "{{ route('home.detail_book', ['book_slug']) }}".replace('book_slug', value.book_slug);
                                            a.className = 'text-decoration-none';
                                            // div
                                            const div1 = document.createElement('div');
                                            div1.className = 'd-flex justify-content-start align-items-center';
                                            // div
                                            const div2 = document.createElement('div');
                                            div2.className = 'me-2';
                                            //img
                                            const img = document.createElement('img');
                                            img.src = value.book_image == null ?
                                                "{{asset('assets/images/no_image.jpg')}}" :
                                                "{{asset('storage/uploads/Sach')}}" + "/" + value.book_image;
                                            // 'assets/images/no_image.jpg':
                                            // 'storage/uploads/Sach/' + value.book_image;
                                            img.className = 'border border-1 rounded';
                                            img.alt = '';
                                            img.width = 40;
                                            img.height = 40;
                                            //div
                                            const div3 = document.createElement('div');
                                            div3.className = 'text-start';
                                            //p
                                            const p1 = document.createElement('p');
                                            p1.className = 'card-text fw-bold mb-0';
                                            p1.style.color = 'darkcyan';
                                            p1.textContent = value.book_name;
                                            //p
                                            const p2 = document.createElement('p');
                                            p2.className = 'card-text text-secondary';
                                            p2.textContent = value.chapter_count + ' Chương';
                                            // Appending elements to create the structure
                                            div2.appendChild(img);
                                            div3.appendChild(p1);
                                            div3.appendChild(p2);
                                            div1.appendChild(div2);
                                            div1.appendChild(div3);
                                            a.appendChild(div1);
                                            child.appendChild(a);
                                            searchResults.append(child);

                                            // child.addEventListener('click', function() {
                                            //     window.location.href = a.href;
                                            // });
                                        }
                                    });
                                    if ($count == 0) {
                                        searchResults.css('display', 'block');
                                        const child = document.createElement('li');
                                        child.className = 'list-group-item';

                                        const p1 = document.createElement('p');
                                        p1.className = 'card-text text-secondary mb-0';
                                        p1.textContent = 'Không tìm thấy';

                                        child.appendChild(p1);
                                        searchResults.append(child);
                                    }
                                });
                            } else {
                                searchResults.css('display', 'none');
                            }
                        })

                    })
                </script>

            </div>
            <!-- cent elements -->

            <!-- Right elements -->
            <div class="col-lg-3 col-md-2 col-4 d-flex justify-content-end">
                <ul class="navbar-nav d-flex align-items-center flex-row">
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link text-secondary" href="{{ route('login') }}">Đăng nhập</a>
                    </li>
                    @endif
                    <li class="nav-item d-none d-lg-block"><a class="mx-1 text-secondary fw-bold">|</a></li>
                    @if (Route::has('register'))
                    <li class="nav-item d-none d-lg-block">
                        <a class="nav-link text-primary fw-bold " href="{{ route('register') }}">Đăng ký</a>
                    </li>
                    @endif
                    @else
                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center py-1" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle me-2" height="30" alt="" loading="lazy" />
                            <i class="fa-solid fa-caret-down" style="color: darkcyan;"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink" style="min-width: 19rem;">
                            <li>
                                <div class="px-3 pt-3 d-flex">
                                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle me-3" height="40" alt="" loading="lazy" />
                                    <div>
                                        <h6 class="mb-0 fw-bold">{{ Auth::guard('web')->user()->name }}</h6>
                                        <p class="mb-2 text-secondary">{{ Auth::guard('web')->user()->email }}</p>
                                        <a class="mb-0 text-primary" href=""><i class="fa-solid fa-address-book me-1"></i>Thông tin cá nhân</a>
                                    </div>
                                </div>
                                <hr class="mb-1">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa-solid fa-unlock me-2"></i>
                                    <span>Đổi mật khẩu</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <i class="fa-brands fa-gratipay me-2" style="color:rgb(220, 29, 68)"></i>
                                    <span>Sách yêu thích</span>
                                </a>
                            </li>
                            <hr class="my-2">
                            <li class="mb-1">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i>
                                        <span>Đăng xuất</span>
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
            <!-- Right elements -->
        </div>
    </div>
</div>
<!-- header -->