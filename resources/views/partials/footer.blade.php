<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <!-- Information Column -->
            <div class="col-md-4">
                <h5>Інформація</h5>
                <ul class="list-unstyled">
                    <li>    <a class="nav-link" href="{{ url('/about-us') }}">Про нас</a></li>
                    <li><a href="/contact-us" class="text-white">Contact Us</a></li>
                    <li><a href="/privacy-policy" class="text-white">Privacy Policy</a></li>
                    <li><a href="/terms-of-service" class="text-white">Terms of Service</a></li>
                </ul>
            </div>

            <!-- Categories Column -->
            <div class="col-md-4">
                <h5>Категорії</h5>
                <ul class="list-unstyled">
                    @foreach($categories as $category)
                        <li class="nav-item"><a href="/category/{{$category->slug}}" class="nav-link text-white">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-md-4">
                <h5>Інформація про магазин</h5>
                <ul class="list-unstyled">
                    <li><strong>Адреса:</strong> ул. Геологов 7, Хмельницький, Україна</li>
                    <li><strong>Телефон:</strong></li>
                    <li>+380 (67) 162-09-88, Людмила</li>
                    <li>+380 (68) 421-95-34, Вадим</li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="text-center mt-4">
            <p>&copy; {{ date('Y') }} Kalina-style. All rights reserved.</p>
        </div>
    </div>
</footer>
