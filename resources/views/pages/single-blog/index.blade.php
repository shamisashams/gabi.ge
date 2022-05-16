@extends('layouts.base')
@section('head')
    <title>{{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->meta_title : null}}</title>
@endsection
@section('description'){{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->description : null}}@endsection
@section('keywords'){{count($page->availableLanguage) > 0 ? $page->availableLanguage[0]->description : null}}@endsection
@section('content')


    <section class="blogs_page single_blog wrapper">
        <div class="showcase flex center">
            <div class="showcase_innerbox flex center">
                <div class="bold">Very long article header for visual purposes only</div>
                <p>Read the stories you love to know</p>
            </div>
        </div>
        <div class="container">
            <div class="heading flex">
                <div class="shallow date">10/02/2022</div>
                <div class="flex">
                    <div class="flex center shallow">
                        <img src="/img/icons/blogs/share.svg" alt=""/>
                        <span>223</span>
                    </div>
                    <div class="flex center shallow">
                        <img src="/img/icons/blogs/eye.svg" alt=""/>
                        <span>799</span>
                    </div>
                    <div class="flex center " style="color: #000;"> 
                        <img src="/img/icons/blogs/share2.svg" alt=""/>
                        <span >Share</span>
                    </div>
                </div>
            </div>
            <div class="content">

                <p>ბლოგი ჩვეულებრივ წარმოადგენს ერთი ან რამდენიმე ადამიანის მიერ წარმოებულს (1) 
                ვებ-საიტს, რეგულარული ჩანაწერებით, რომლებიც აღწერენ სხვადასხვა მოვლენებს ან/
                და შეიცავენ გრაფიკულ-ვიდეო-აუდიო მასალას. ჩანაწერები როგორც წესი 
                განლაგებულია უკუქრონოლოგიურად.ბლოგების უმეტესობა შეიცავს კომენტარს ან ახალ 
                ამბავს კონკრეტული თემის შესახებ; ზოგჯერ კი წარმოადგენს ონლაინ დღიურს. ტიპიური 
                ბლოგი აერთიანებს ტექსტს, გამოსახულებას, ბლოგების, ვებ-საიტების ლინკებს და სხვა 
                თემასთან დაკავშირებულ მედიას. მკითხველების მიერ კომენტარების დატოვების 
                საშუალება ინტერაქტიული ფორმატით ბევრი ბლოგის მნიშვნელოვანი ნაწილია.</p>
                            <p>ბლოგი ჩვეულებრივ წარმოადგენს ერთი ან რამდენიმე ადამიანის მიერ წარმოებულს (1) 
                ვებ-საიტს, რეგულარული ჩანაწერებით, რომლებიც აღწერენ სხვადასხვა მოვლენებს ან/
                და შეიცავენ გრაფიკულ-ვიდეო-აუდიო მასალას. ჩანაწერები როგორც წესი 
                განლაგებულია უკუქრონოლოგიურად.ბლოგების უმეტესობა შეიცავს კომენტარს ან ახალ 
                ამბავს კონკრეტული თემის შესახებ; ზოგჯერ კი წარმოადგენს ონლაინ დღიურს. ტიპიური 
                ბლოგი აერთიანებს ტექსტს, გამოსახულებას, ბლოგების, ვებ-საიტების ლინკებს და სხვა 
                თემასთან დაკავშირებულ მედიას. მკითხველების მიერ კომენტარების დატოვების 
                საშუალება ინტერაქტიული ფორმატით ბევრი ბლოგის მნიშვნელოვანი ნაწილია.</p>
                <img src="/img/blogs/3.png" alt="">
                <p>ბლოგი ჩვეულებრივ წარმოადგენს ერთი ან რამდენიმე ადამიანის მიერ წარმოებულს (1) 
                ვებ-საიტს, რეგულარული ჩანაწერებით, რომლებიც აღწერენ სხვადასხვა მოვლენებს ან/
                და შეიცავენ გრაფიკულ-ვიდეო-აუდიო მასალას. ჩანაწერები როგორც წესი 
                განლაგებულია უკუქრონოლოგიურად.ბლოგების უმეტესობა შეიცავს კომენტარს ან ახალ 
                ამბავს კონკრეტული თემის შესახებ; ზოგჯერ კი წარმოადგენს ონლაინ დღიურს. ტიპიური 
                ბლოგი აერთიანებს ტექსტს, გამოსახულებას, ბლოგების, ვებ-საიტების ლინკებს და სხვა 
                თემასთან დაკავშირებულ მედიას. მკითხველების მიერ კომენტარების დატოვების 
                საშუალება ინტერაქტიული ფორმატით ბევრი ბლოგის მნიშვნელოვანი ნაწილია.</p>
                            <p>ბლოგი ჩვეულებრივ წარმოადგენს ერთი ან რამდენიმე ადამიანის მიერ წარმოებულს (1) 
                ვებ-საიტს, რეგულარული ჩანაწერებით, რომლებიც აღწერენ სხვადასხვა მოვლენებს ან/
                და შეიცავენ გრაფიკულ-ვიდეო-აუდიო მასალას. ჩანაწერები როგორც წესი 
                განლაგებულია უკუქრონოლოგიურად.ბლოგების უმეტესობა შეიცავს კომენტარს ან ახალ 
                ამბავს კონკრეტული თემის შესახებ; ზოგჯერ კი წარმოადგენს ონლაინ დღიურს. ტიპიური 
                ბლოგი აერთიანებს ტექსტს, გამოსახულებას, ბლოგების, ვებ-საიტების ლინკებს და სხვა 
                თემასთან დაკავშირებულ მედიას. მკითხველების მიერ კომენტარების დატოვების 
                საშუალება ინტერაქტიული ფორმატით ბევრი ბლოგის მნიშვნელოვანი ნაწილია.</p>
                <img src="/img/blogs/5.png" alt="">
                <p>ბლოგი ჩვეულებრივ წარმოადგენს ერთი ან რამდენიმე ადამიანის მიერ წარმოებულს (1) 
                ვებ-საიტს, რეგულარული ჩანაწერებით, რომლებიც აღწერენ სხვადასხვა მოვლენებს ან/
                და შეიცავენ გრაფიკულ-ვიდეო-აუდიო მასალას. ჩანაწერები როგორც წესი 
                განლაგებულია უკუქრონოლოგიურად.ბლოგების უმეტესობა შეიცავს კომენტარს ან ახალ 
                ამბავს კონკრეტული თემის შესახებ; ზოგჯერ კი წარმოადგენს ონლაინ დღიურს. ტიპიური 
                ბლოგი აერთიანებს ტექსტს, გამოსახულებას, ბლოგების, ვებ-საიტების ლინკებს და სხვა 
                თემასთან დაკავშირებულ მედიას. მკითხველების მიერ კომენტარების დატოვების 
                საშუალება ინტერაქტიული ფორმატით ბევრი ბლოგის მნიშვნელოვანი ნაწილია.</p>
                            <p>ბლოგი ჩვეულებრივ წარმოადგენს ერთი ან რამდენიმე ადამიანის მიერ წარმოებულს (1) 
                ვებ-საიტს, რეგულარული ჩანაწერებით, რომლებიც აღწერენ სხვადასხვა მოვლენებს ან/
                და შეიცავენ გრაფიკულ-ვიდეო-აუდიო მასალას. ჩანაწერები როგორც წესი 
                განლაგებულია უკუქრონოლოგიურად.ბლოგების უმეტესობა შეიცავს კომენტარს ან ახალ 
                ამბავს კონკრეტული თემის შესახებ; ზოგჯერ კი წარმოადგენს ონლაინ დღიურს. ტიპიური 
                ბლოგი აერთიანებს ტექსტს, გამოსახულებას, ბლოგების, ვებ-საიტების ლინკებს და სხვა 
                თემასთან დაკავშირებულ მედიას. მკითხველების მიერ კომენტარების დატოვების 
                საშუალება ინტერაქტიული ფორმატით ბევრი ბლოგის მნიშვნელოვანი ნაწილია.</p>
            </div>
            <div class="flex center " style="color: #000;">
                    <img style="margin-right: 8px" src="/img/icons/blogs/share2.svg" alt=""/>
                    <span >Share</span>
                </div>
        </div>
     <div style="color: #000;">  You may like</div> 
        <div class="blog_grid">
            <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['single-blog']['slug']) ? $page_slugs['single-blog']['slug'] : null])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="/img/blogs/3.png" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">Header of the article</div>
                        <div class="date shallow">10/02/2022</div>
                    </div>
                    <div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>799</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['single-blog']['slug']) ? $page_slugs['single-blog']['slug'] : null])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="/img/blogs/4.png" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">Header of the article</div>
                        <div class="date shallow">10/02/2022</div>
                    </div>
                    <div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>799</span>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{route('viewPage',[app()->getLocale(),isset($page_slugs['single-blog']['slug']) ? $page_slugs['single-blog']['slug'] : null])}}" class="blog_box">
                <div class="img_frame">
                    <div class="read_more">Read more</div>
                    <div class="img">
                        <img src="/img/blogs/5.png" alt=""/>
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <div class="head">Header of the article</div>
                        <div class="date shallow">10/02/2022</div>
                    </div>
                    <div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/share.svg" alt=""/>
                            <span>223</span>
                        </div>
                        <div class="flex center shallow">
                            <img src="/img/icons/blogs/eye.svg" alt=""/>
                            <span>799</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </section>


@endsection
