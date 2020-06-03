@extends('front_end.index')
@section('content')
    <section class="home-slider owl-carousel">
        <div class="slider-item" style="background-image:url('{{url('public/design/site/images/bg_1.jpg')}}');">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                    <div class="col-md-8 text-center ftco-animate">
                        <img src="{{asset('public/images/website/'.settingHelper()->logo)}}" style="width:100px;height:100px;margin-left: auto; margin-right: auto;">
                        <h1 class="mb-4">Kids Are The Best <span>Explorers In The World</span></h1>
                        {{--  <p><a href="#" class="btn btn-secondary px-4 py-3 mt-3">Read More</a></p>  --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="slider-item" style="background-image:url({{url('public/design/site/images/bg_2.jpg')}});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text align-items-center justify-content-center" data-scrollax-parent="true">
                    <div class="col-md-8 text-center ftco-animate">
                        <img src="{{asset('public/images/website/'.settingHelper()->logo)}}" style="width:100px;height:100px;margin-left: auto; margin-right: auto;">

                        <h1 class="mb-4">Perfect Education<span> For Your Child</span></h1>
                        {{--  <p><a href="#" class="btn btn-secondary px-4 py-3 mt-3">Read More</a></p>  --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-services ftco-no-pb">
        <div class="container-wrap">
            <div class="row no-gutters">
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-primary">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-teacher"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Etiquette</h3>
                            <p style="text-align: justify">In our school, we do enhance and encourage our students to usually behave in the form of an ethical code.
                                These ethical codes delineates the expected and accepted social behaviors that accord with the conventions and norms observed by the School Community.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-tertiary">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-reading"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Montessori</h3>
                            <p style="text-align: justify">Fine motor skills are involved in smaller movements that occur in the wrists, hands, fingers, feet and toes. They involve smaller actions such as picking up objects between the thumb and finger, writing carefully, and even blinking. These two motor skills work together to strength and dexterity in their hands and fingers before being asked to manipulate a pencil on paper.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-fifth">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-books"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Interactive learning </h3>
                            <p style="text-align: justify">The Interactive Learning increases the students’ ability to learn in new ways outside the classroom, this generation of students is pushing the boundaries of education. The use of digital media in education has led to an increase in the use of and reliance on interactive learning, which in turn has led to a revolution in the fundamental process of education.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 d-flex services align-self-stretch pb-4 px-4 ftco-animate bg-quarternary">
                    <div class="media block-6 d-block text-center">
                        <div class="icon d-flex justify-content-center align-items-center">
                            <span class="flaticon-diploma"></span>
                        </div>
                        <div class="media-body p-2 mt-3">
                            <h3 class="heading">Sports Acadmic</h3>
                            <p style="text-align: justify">Physical exercise is good for mind, body and spirit. Furthermore, team sports are good for learning accountability, dedication, and leadership, among many other traits. Putting it all together by playing a sport is a winning combination.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt ftc-no-pb" >
        <div class="container">
            <div class="row" style="margin: 25px 0">
                <div class="col-md-6 order-md-last wrap-about py-6 wrap-about bg-light">
                    <div class="text px-4 ftco-animate">
                        <h2 class="mb-4">Welcome to Middle East Schools Official Website</h2>
                        <p>A high-quality education gives students a wider choice and better chances in college and university.
                            In these pages, you can learn more about MEIS, the curriculum, extracurricular activities, facilities, and requirements for admission, registration procedures, and other aspects of the schools that may be of interest to you.</p>
                    </div>
                </div>
                <div class="col-md-6 order-md-last wrap-about py-6 wrap-about bg-light">
                    <div class="text px-4 ftco-animate">
                        <h2 class="mb-4">Welcome message of the School Chairman</h2>
                        <p>Welcome message of the school Chairman: Thank you for taking an interest in Middle East International School (MIES) founded in 2013. We are very proud to offer our students, of all nationalities, a quality international education.
                            MEIS represents and develops the student's national identities and prepares them with the skills and knowledge needed to contribute in making their world a better place.
                            Looking forward to welcoming you in our horizon, seeking for brilliant future.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-intro" style="background-image: url({{url('public/design/site/images/bg_3.jpg') }});" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h2>Teaching Your Child Some Good Manners</h2>
                    <p class="mb-0">As a school and caregivers, helping our students develop social skills, including how to interact politely in everyday situations, is one of the most important duties we have. </p>
                </div>
                <div class="col-md-3 d-flex align-items-center">
                    {{--  <p class="mb-0"><a href="#" class="btn btn-secondary px-4 py-3">Take a Course</a></p>  --}}
                </div>
            </div>
        </div>
    </section>
    {{--  divisions  --}}
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-4 ftco-animate">
                    <div class="pricing-entry bg-light pb-4 text-center">
                        <div>
                            <h3 class="mb-3" style="color: green">National Division</h3>
                            {{--  <p><span class="price">9.000 LE</span>  --}}
                        </div>
                        <div class="img" style="background-image: url({{ url('public/design/site/images/bg_1.jpg') }});"></div>
                        <div class="px-4">
                            <p style="text-align:justify;">At our National Division  we put students first. Our school focus is to provide broad and balanced education in a family environment where everybody feels safe and where the potential of every single student can flourish. We are committed to excellence and our mission is to help children learn better. For that reason, we fully promote Fundamental Traditional Values. This includes: Tolerance of those of different faiths and beliefs,Mutual Respect and Cooperation.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 ftco-animate">
                    <div class="pricing-entry bg-light pb-4 text-center">
                        <div>
                            <h3 class="mb-3" style="color: purple">Semi-International Division</h3>
                            {{--  <p><span class="price">12.000 LE</span>  --}}
                        </div>
                        <div class="img" style="background-image: url({{ url('public/design/site/images/bg_2.jpg') }});"></div>
                        <div class="px-4">
                            <p style="text-align:justify;">The school accomplishes its mission through a variety of educational philosophies and methods with an emphasis on development of academic, personal and international competencies. We strongly value individual approach and strive to create a positive and supportive atmosphere in which students’ knowledge, skills and understanding is formed by excellent staff working with close partnership with parents.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 ftco-animate">
                    <div class="pricing-entry bg-light active pb-4 text-center">
                        <div>
                            <h3 class="mb-3" style="color: blue">British Division</h3>
                            {{--  <p><span class="price">20.000 LE</span>  --}}
                        </div>
                        <div class="img" style="background-image: url({{ url('public/design/site/images/bg_3.jpg') }});"></div>
                        <div class="px-4">
                            <p style="text-align:justify;">We support students and the increasingly challenging curriculum through various programmes that are authorized by the British Council.</p>
                            <p style="text-align:justify;">Through a variety of lessons, individual attitude of enthusiastic teachers and exciting curriculum, students realize their academic potential, We support students in their life and study so they can gradually manage higher learning expectations as we help them become 21st century global citizens.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script src="{{url('public/design/site/js/jquery.min.js')}}"></script>
    <script src="{{url('public/design/site/js/jquery-migrate-3.0.1.min.js')}}"></script>
@endsection
