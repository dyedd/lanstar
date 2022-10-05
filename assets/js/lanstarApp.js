eval(function (p, a, c, k, e, r) {
    e = function (c) {
        return c.toString(a)
    };
    if (!''.replace(/^/, String)) {
        while (c--) r[e(c)] = k[c] || e(c);
        k = [function (e) {
            return r[e]
        }];
        e = function () {
            return '\\w+'
        };
        c = 1
    }
    ;
    while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
    return p
}('a.f(\' %c 9 1 %c b://d.e/8/1\',\'2:#3;4:#5;6:7 0\',\'2:#5;4:#3;6:7\');', 16, 16, '|lanstar|color|444|background|eee|padding|5px|dyedd|Theme|console|https||github|com|log'.split('|'), 0, {}));


let lanstar = {
    init: function () {
        this.addCommentInit()
        this.addSearchEvent()
        this.addDarkMode()
        this.addMobileSwitch()
        this.addScroll()
        this.addArticleLike();
        this.addProcess();
        this.addInitTabs();
        this.addInitCollapse();
        this.addCarouselEnter();
        this.addMorePages();
        this.addEmoji()
        this.addHighLight();
        this.addComment();
        this.addPageLike();
        this.addArchiveToggle()
        this.addPostProtect();
        this.addCommentSecret();
    },
    addFunc: () => {
        let getCookie = function (cookieName)
            /**
             * 获取 cookie
             * @param cookieName
             * @returns {string}
             */ {
            let name = cookieName + "=";
            let ca = document.cookie.split(';');
            for (let i = 0; i < ca.length; i++) {
                let c = ca[i].trim();
                if (c.indexOf(name) === 0) return c.substring(name.length, c.length);
            }
            return "";
        }
        return {
            getCookie,
        }
    },
    addSearchEvent: function () {
        $('.close').on('click', function () {
            $('.search-block').collapse('hide');
        })
        let searchBlock = $('#search-block')
        searchBlock.on('show.bs.collapse', function () {
            $('.nav-menu').css({'position': 'relative', 'z-index': '-1'})
            $('#carouselExampleIndicators').css({'position': 'relative', 'z-index': '-1'})
            $('.user-container').css({'position':'relative','z-index':'-1'})
        })
        searchBlock.on('hidden.bs.collapse', function () {
            $('.nav-menu').removeAttr('style')
            $('#carouselExampleIndicators').removeAttr('style')
            $('.user-container').removeAttr('style')
        })
    },
    addMobileSwitch: function () {
        $(".mobile-button").on("click",function () {
            $(".mobile-nav > .logo-box").addClass("d-none").parent().removeClass("col d-none").show(1000)
                .addClass("active").find(".nav-menu").css({
                "margin":'0 0 .5rem 0',
            })
            $(".right").children().not("footer").appendTo($(".mobile-nav"))
        })
        $(".mobile-close").on("click",function (){
            console.log(this)
            $(".mobile-nav").hide(1000)
        })
    },
    addDarkMode: function () {
        if(config['dark'] == '0') return false;
        // 根据时间
        let timeNow = new Date();
        // 获取当前小时
        let hours = timeNow.getHours();
        let storage = window.localStorage;
        if (storage.getItem('gmtNightMode')) {
            $('body').addClass('theme-dark');
            $('#carouselCaptions').addClass('carousel-dark')
            $('.chose-mode-day').css('display', 'none');
            $('.chose-mode-moon').css('display', 'inline-block');
            document.cookie = "night=1;path=/";
        }else{
            // 自动
            if (!this.addFunc().getCookie('night')) {
                if (hours > 6 && hours < 19) {
                    $('body').removeClass('theme-dark');
                    $('#carouselCaptions').removeClass('carousel-dark')
                } else {
                    $('body').addClass('theme-dark');
                    $('#carouselCaptions').addClass('carousel-dark')
                }
            }

        }
        $(document).on('click', '#night-mode', function (event) {
            event.preventDefault();
            let storage = window.localStorage;
            /*
            * 以下都是动画
            * */
            $('<div class="ze_DarkSky"><div class="ze_DarkPlanet"><svg class="moon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 1024 1024"><path d="M483.555556 964.266667c-164.977778 0-315.733333-85.333333-398.222223-224.711111 19.911111 2.844444 39.822222 2.844444 56.888889 2.844444 275.911111 0 500.622222-224.711111 500.622222-500.622222 0-68.266667-14.222222-133.688889-39.822222-193.422222 201.955556 54.044444 347.022222 238.933333 347.022222 449.422222 0 256-210.488889 466.488889-466.488888 466.488889z" fill="#FFE35E"></path><path d="M631.466667 73.955556c179.2 62.577778 301.511111 230.4 301.511111 423.822222 0 247.466667-201.955556 449.422222-449.422222 449.422222-147.911111 0-281.6-71.111111-364.088889-187.733333H142.222222c284.444444 0 517.688889-233.244444 517.688889-517.688889 0-56.888889-8.533333-113.777778-28.444444-167.822222M571.733333 22.755556C605.866667 88.177778 625.777778 162.133333 625.777778 241.777778c0 267.377778-216.177778 483.555556-483.555556 483.555555-31.288889 0-59.733333-2.844444-88.177778-8.533333 79.644444 156.444444 241.777778 264.533333 429.511112 264.533333 267.377778 0 483.555556-216.177778 483.555555-483.555555C967.111111 261.688889 796.444444 65.422222 571.733333 22.755556z" fill="#303133"></path><path d="M787.911111 455.111111c-5.688889-2.844444-8.533333-8.533333-5.688889-14.222222 5.688889-17.066667-2.844444-42.666667-19.911111-48.355556-17.066667-5.688889-39.822222 8.533333-45.511111 22.755556-2.844444 5.688889-8.533333 8.533333-14.222222 5.688889-5.688889-2.844444-8.533333-8.533333-5.688889-14.222222 8.533333-25.6 42.666667-45.511111 73.955555-34.133334 28.444444 11.377778 39.822222 48.355556 31.288889 73.955556-2.844444 5.688889-8.533333 8.533333-14.222222 8.533333" fill="#303133"></path><path d="M608.711111 620.088889c-14.222222 0-28.444444-2.844444-39.822222-11.377778-31.288889-22.755556-31.288889-65.422222-31.288889-68.266667 0-8.533333 8.533333-17.066667 17.066667-17.066666s17.066667 8.533333 17.066666 17.066666 2.844444 31.288889 17.066667 39.822223c11.377778 8.533333 25.6 8.533333 45.511111 0 8.533333-2.844444 19.911111 2.844444 22.755556 11.377777 2.844444 8.533333-2.844444 19.911111-11.377778 22.755556-14.222222 2.844444-25.6 5.688889-36.977778 5.688889zM571.733333 540.444444z" fill="#303133"></path><path d="M810.666667 588.8c-5.688889 19.911111-36.977778 28.444444-68.266667 19.911111-31.288889-8.533333-54.044444-34.133333-48.355556-54.044444 5.688889-19.911111 36.977778-28.444444 68.266667-19.911111 34.133333 11.377778 54.044444 34.133333 48.355556 54.044444" fill="#FFA450"></path><path d="M864.711111 270.222222c14.222222 42.666667 19.911111 91.022222 19.911111 136.533334 0 258.844444-213.333333 466.488889-477.866666 466.488888-96.711111 0-187.733333-28.444444-264.533334-76.8 82.488889 93.866667 204.8 156.444444 344.177778 156.444445C736.711111 952.888889 938.666667 756.622222 938.666667 512c0-88.177778-28.444444-173.511111-73.955556-241.777778z" fill="#FFC93F"></path></svg><svg class="sun" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0" y="0" viewBox="0 0 1118 1024"><path d="M228.57614222 516.12330667C228.57614222 714.42659555 389.63996445 875.09105778 588.20949333 875.09105778c198.56952889 0 359.63335111-160.79758222 359.63335112-358.96888889S786.77902222 157.15441778 588.20949333 157.15441778c-198.70264889 0-359.63335111 160.66446222-359.63335111 358.96888889Zm0 0" fill="#f9d706"></path><path d="M346.68088889 251.31918222c103.47440355-94.03141689 252.30222222-119.43480889 381.17944889-65.03719822C856.73756445 240.67868445 942.25635555 365.03438222 946.91214222 504.81834667s-72.21930667 269.59189333-197.10634667 332.63388444c132.86741333-120.76487111 156.14293333-321.19580445 54.39715556-469.09326222-101.74543645-147.89632-297.25582222-197.90506667-457.52206222-117.04092444Zm0 0" fill="#febd34"></path><path d="M393.23079111 215.54176c112.51848533-73.28324267 256.55751111-77.67233422 373.33219556-11.30503965 116.77468445 66.36726045 186.73322667 192.31857778 181.27985778 326.64917334C942.38947555 665.08344889 862.58915555 785.0496 740.76046222 841.84177778c157.87121778-102.94237867 209.34314667-310.29020445 117.83850667-475.07797333-91.37129245-164.78776889-294.59569778-230.75612445-465.36931556-151.22204445Zm0 0" fill="#fa9f45"></path><path d="M418.76707555 471.43480889c0 9.5760384 5.05402027 18.48706845 13.43305956 23.27506489 8.24603307 4.7880192 18.48706845 4.7880192 26.86611911 0 8.24603307-4.7880192 13.43305955-13.699072 13.43305956-23.27506489 0-9.5760384-5.05402027-18.48706845-13.43305956-23.27506489-8.24603307-4.7880192-18.48706845-4.7880192-26.86611911 0-8.24603307 4.7880192-13.43305955 13.699072-13.43305956 23.27506489Zm0 0M639.41404445 471.43480889c0 9.5760384 5.05402027 18.48706845 13.43305955 23.27506489 8.24603307 4.7880192 18.48706845 4.7880192 26.86611911 0 8.24603307-4.7880192 13.43305955-13.699072 13.43305956-23.27506489 0-9.5760384-5.05402027-18.48706845-13.43305956-23.27506489-8.24603307-4.7880192-18.48706845-4.7880192-26.86611911 0-8.24603307 4.7880192-13.43305955 13.699072-13.43305955 23.27506489Zm0 0" fill=""></path><path d="M495.77415111 577.56899555h137.12384c0 37.90518045-30.723072 68.62825245-68.62825244 68.62825245-37.77217422 0-68.49524622-30.723072-68.49524622-68.62825245Zm0 0" fill="#f48373"></path><path d="M564.26951111 655.10855111c-43.09219555 0-78.603264-33.91510755-80.46535111-76.87429689-0.13300053-3.32500765 1.06400427-6.51702045 3.32500765-8.7780352 2.26101475-2.3940096 5.32002133-3.72401493 8.64502897-3.72401493h137.12384c3.32500765 0 6.3840256 1.33000533 8.64502898 3.72401493 2.26101475 2.3940096 3.45801387 5.5860224 3.32500765 8.7780352-1.99501369 42.95918933-37.50616178 76.87429689-80.59835734 76.87429689Zm-54.79617422-65.56922311c6.3840256 25.00414578 28.99410489 42.56017067 54.92918044 42.56017067 25.80206933 0 48.41221689-17.55602489 54.79617422-42.56017067h-109.72546844Zm0 0" fill=""></path><path d="M705.64864 582.88924445c0 11.03903858 5.85202347 21.28008533 15.56104533 26.8661191 9.5760384 5.5860224 21.41309155 5.5860224 30.98908445 0 9.5760384-5.5860224 15.56104533-15.82705778 15.56104533-26.8661191 0-11.03903858-5.85202347-21.28008533-15.56104533-26.86611912-9.5760384-5.5860224-21.41309155-5.5860224-30.98908445 0-9.5760384 5.5860224-15.56104533 15.82705778-15.56104533 26.86611912Zm0 0" fill="#f79121"></path><path d="M561.14289778 914.45930667c-211.60391111 0-383.17397333-171.30496-383.44021333-382.90887112-0.13300053-55.46120533 11.83709867-110.12437333 35.24516977-160.39822222 5.5860224-11.96999111 19.81713067-17.29001245 31.920128-11.57108622 11.96999111 5.5860224 17.29001245 19.81713067 11.57108623 31.920128-20.482048 43.89011911-30.98908445 91.77031111-30.98908445 140.18218667 0.26600107 136.8576 83.65727289 259.88323555 210.67320889 310.95466667 127.01582222 50.93922133 272.38513778 19.81713067 367.21436444-79.00228267 9.17703111-8.91103005 23.80708978-9.04403627 32.98417778-0.13300053 9.31003733 8.7780352 9.97503431 23.40807111 1.5960064 32.98417777-72.08630045 75.67724089-172.23566222 118.37098667-276.77354666 117.97162667ZM863.45386667 748.74083555c-8.7780352 0.13300053-17.02411378-4.65501298-21.28008534-12.36900977-4.25601707-7.71403093-3.85700978-17.15712 0.93100374-24.60512711 15.29503289-23.80708978 27.53115022-49.47615289 36.442112-76.342272 4.12301085-12.502016 17.55602489-19.28510578 30.05815466-15.16202667 12.502016 4.12301085 19.28510578 17.55602489 15.16202667 30.05815467-9.97503431 30.59006578-23.80708978 59.85018311-41.09710222 87.11532088-4.25601707 7.04902258-11.83709867 11.30503965-20.21603556 11.30503965Zm56.65826133-193.78176c-13.16704711 0-23.80708978-10.64004267-23.80708978-23.80708977-0.66500267-184.73756445-150.42332445-334.23018667-335.16088889-334.49642667l-32.18614044 1.72900124c-8.51203413 0.93100373-16.89110755-2.79300551-21.94511644-9.84203946-5.05402027-6.91602773-5.98501831-16.09307022-2.3940096-23.940096s11.03903858-13.16704711 19.55111822-13.96508444l36.97413688-1.72900125c211.60391111 0 383.17397333 171.30496 383.44021334 382.90887111 0 6.3840256-2.66001067 12.63502222-7.1820288 17.02411378-4.65501298 4.52201813-10.77303751 6.91602773-17.29001244 6.78302151v-0.66500267ZM286.89635555 322.87288889c-9.31003733-0.13300053-17.68903111-5.5860224-21.54609777-13.96508444-3.85700978-8.37902791-2.3940096-18.35406222 3.59100871-25.40305067 20.34904178-24.07310222 43.62422045-45.48619378 69.16027733-63.840256 10.77303751-7.71403093 25.66906311-5.32002133 33.38308267 5.32002133 7.71403093 10.77303751 5.32002133 25.66906311-5.32002134 33.38308267-22.47714133 16.09307022-42.95918933 34.97915733-60.78122666 55.99323022-4.65501298 5.5860224-11.43808 8.64502898-18.48706844 8.51203413Zm128.74410667-95.89339022c-11.43808 0.26600107-21.54609778-7.71403093-23.80708977-19.01909334s3.72401493-22.61003378 14.3641031-26.86611911l32.85117156-11.96999111c12.502016-4.25601707 26.06808178 2.3940096 30.45705956 14.89601422 4.25601707 12.502016-2.3940096 26.06808178-14.89601422 30.45705956l-29.26011734 10.77303751c-3.1920128 1.06400427-6.3840256 1.72900125-9.70903324 1.72900125Zm0 0" fill="#fb7419"></path><path d="M310.90346667 582.88924445c0 11.03903858 5.85202347 21.28008533 15.56104533 26.8661191 9.5760384 5.5860224 21.41309155 5.5860224 30.98908445 0 9.5760384-5.5860224 15.56104533-15.82705778 15.56104533-26.8661191 0-11.03903858-5.85202347-21.28008533-15.56104533-26.86611912-9.5760384-5.5860224-21.41309155-5.5860224-30.98908445 0-9.70903325 5.5860224-15.56104533 15.82705778-15.56104533 26.86611912Zm0 0" fill="#f79121"></path><path d="M611.48387555 1067.80444445c-8.7780352 0.13300053-16.35908267-6.25101938-17.95504355-14.89601423l-9.5760384-53.73223822c-0.93100373-9.31003733 5.5860224-17.82203733 14.763008-19.28510578 9.17703111-1.5960064 18.08804978 4.25601707 20.34904178 13.43305956l9.5760384 53.73223822c0.93100373 4.65501298-0.13300053 9.44303218-2.79300551 13.43305955-2.66001067 3.85700978-6.78302151 6.65002667-11.43808 7.44802987h-2.92601174Zm-356.04252444-88.844288c-6.3840256 0-12.23600355-3.45801387-15.56104533-8.91103005-3.1920128-5.5860224-3.1920128-12.36900978 0-17.95504355L267.27879111 904.35128889c3.1920128-5.5860224 9.04403627-9.17703111 15.56104534-9.17703111 6.51702045 0 12.502016 3.45801387 15.69405155 9.04403627 3.1920128 5.5860224 3.1920128 12.502016-0.13300053 18.08804977l-27.398144 47.74718578c-3.32500765 5.45301618-9.17703111 8.91103005-15.56104534 8.91103005Zm685.75118222-71.55427556c-4.12301085 0-8.11302685-1.46301155-11.30503964-4.12301084l-41.76213334-35.24516978c-4.92101405-4.12301085-7.1820288-10.64004267-6.11802453-16.89110756 1.19701049-6.3840256 5.5860224-11.57108622 11.57108623-13.699072 5.98501831-2.12800853 12.76802845-0.93100373 17.6890311 3.1920128l41.76213334 35.24516978c5.71901725 4.7880192 7.84702578 12.63502222 5.32002133 19.81713066-2.52700445 7.04902258-9.17703111 11.83709867-16.62509511 11.83709867h-0.53200213ZM40.114176 681.97489778c-8.51203413-0.26600107-15.69405155-6.3840256-17.15712-14.89601423-1.46301155-8.37902791 3.1920128-16.62509511 11.1720448-19.68412444l51.33824-18.48706844c8.91103005-2.52700445 18.35406222 2.12800853 21.679104 10.90604373s-0.66500267 18.48706845-9.17703111 22.47714133l-51.87015111 18.48706845-5.98501831 1.19701049ZM1036.02176 572.24874667c-9.84203947 0-17.95504355-7.980032-17.95504355-17.82203734s7.980032-17.95504355 17.95504355-17.95504355h54.79617422c9.84203947 0 17.95504355 7.980032 17.95504356 17.95504355 0 9.84203947-7.980032 17.82203733-17.95504356 17.82203734H1036.02176ZM117.65304889 334.31096889l-5.98501831-1.19701049-51.87015111-18.48706845c-7.980032-4.12301085-11.70409245-13.43305955-8.64502898-21.94511644 3.05900658-8.37902791 11.83709867-13.30005333 20.61505422-11.43808l51.87015111 18.48706844c7.980032 3.05900658 12.63502222 11.30503965 11.1720448 19.68412445-1.46301155 8.37902791-8.64502898 14.63000178-17.15712 14.89601422Zm830.05667556-79.93332622c-7.44802987 0-14.09809067-4.7880192-16.62509512-11.83709867-2.52700445-7.04902258-0.3990016-14.89601422 5.32002134-19.81713067l41.76213333-35.24516978c7.58102471-6.3840256 18.88608711-5.45301618 25.40305067 2.12800854 6.3840256 7.58102471 5.45301618 18.88608711-2.12800854 25.40305066l-41.76213333 35.24516978c-3.32500765 2.66001067-7.58102471 4.25601707-11.96999111 4.12301085ZM348.40917333 99.29955555c-6.3840256 0-12.36900978-3.45801387-15.56104533-8.91103004l-27.398144-47.08215466c-3.32500765-5.5860224-3.32500765-12.502016-0.13300053-18.08804978 3.1920128-5.5860224 9.17703111-9.04403627 15.69405155-9.04403627s12.36900978 3.59100871 15.56104533 9.17703111l27.398144 47.08215467c3.1920128 5.5860224 3.1920128 12.36900978 0 17.95504355-3.1920128 5.45301618-9.17703111 8.91103005-15.56104533 8.91103005Zm327.97923556-31.65411555h-2.92601174c-4.65501298-0.93100373-8.7780352-3.59100871-11.43808-7.44802987-2.66001067-3.85700978-3.72401493-8.7780352-2.7930055-13.43305955l9.5760384-53.73223823c2.26101475-9.04403627 11.1720448-14.89601422 20.34904177-13.43305955 9.17703111 1.5960064 15.69405155 9.97503431 14.763008 19.28510578l-9.5760384 53.73223822c-1.46301155 8.91103005-9.04403627 15.16202667-17.95504355 15.02902045Zm0 0" fill="#fb7419"></path></svg></div></div>').appendTo($("body"));
            if ($('body').hasClass("theme-dark")) {
                // 进入白天
                $('.moon').css('display', 'block');
                $('.sun').css('display', 'none');
                storage.removeItem('gmtNightMode');
                document.cookie = "night=0;path=/";
            } else {
                // 侧边栏按钮变色
                $(".btn-close").addClass("btn-close-white")

                $('.sun').css('display', 'block');
                $('.moon').css('display', 'none');
                storage.setItem('gmtNightMode', true);
                document.cookie = "night=1;path=/";
            }
            setTimeout(function () {
                if (storage.getItem('gmtNightMode')) {
                    $('.moon').css('display', 'block');
                    $('.sun').css('display', 'none');
                } else {
                    $('.sun').css('display', 'block');
                    $('.moon').css('display', 'none');
                }
                $('body')[0].classList.toggle('theme-dark');
                $('#carouselCaptions')[0].classList.toggle('carousel-dark')
            }, 900)
            setTimeout(function () {
                $(".ze_DarkSky").fadeOut(1e3, function () {
                    $(this).remove()
                })
            }, 2e3)
        });
    },
    addScroll: function () {
        $(window).scroll(function () {
            let scroHei = $(window).scrollTop();

            if (scroHei > 1700) {
                $('.footer').addClass('is-fixed')
            } else {
                $('.footer').removeClass('is-fixed')
            }
        })
    },
    addCommentInit: () => {
        window.TypechoComment = {
            dom: function (id) {
                return document.getElementById(id)
            },
            create: function (tag, attr) {
                var el = document.createElement(tag);
                for (var key in attr) {
                    el.setAttribute(key, attr[key])
                }
                return el
            },
            reply: function (cid, coid) {
                var comment = this.dom(cid),
                    parent = comment.parentNode,
                    response = this.dom($('.article-comments').attr('data-respondid')),
                    input = this.dom('comment-parent'),
                    form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                    textarea = response.getElementsByTagName('textarea')[0];
                if (null == input) {
                    input = this.create('input', {
                        'type': 'hidden',
                        'name': 'parent',
                        'id': 'comment-parent'
                    });
                    form.appendChild(input)
                }
                input.setAttribute('value', coid);
                if (null == this.dom('comment-form-place-holder')) {
                    var holder = this.create('div', {
                        'id': 'comment-form-place-holder'
                    });
                    response.parentNode.insertBefore(holder, response)
                }
                comment.appendChild(response);
                this.dom('cancel-comment-reply-link').style.display = '';
                if (null != textarea && 'text' == textarea.name) {
                    textarea.focus()
                }
                return false
            },
            cancelReply: function () {
                var response = this.dom(this.dom($('.article-comment').attr('data-respondid'))),
                    holder = this.dom('comment-form-place-holder'),
                    input = this.dom('comment-parent');
                if (null != input) {
                    input.parentNode.removeChild(input)
                }
                if (null == holder) {
                    return true
                }
                this.dom('cancel-comment-reply-link').style.display = 'none';
                holder.parentNode.insertBefore(response, holder);
                return false
            }
        }
    },
    addBackTop: function () {
        $('body,html').animate({
            scrollTop: 0
        }, 600);
    },
    addArticleLike: () => {
        // 首页点赞
        $('.artices').on('click','.post-like', function () {
            if ($(this).get(0).getAttribute('class') === 'post-like active')
                return Toastify({
                    text: '你已经点赞过了，取消不了，啦啦啦',
                    duration: 3000,
                    backgroundColor: "linear-gradient(to right, #fa709a 0%, #fee140 100%)"
                }).showToast();
            $.ajax({
                type: 'post',
                data: 'agree=' + $(this).attr('data-cid'),
                async: true,
                timeout: 30000,
                cache: false,
                //  请求成功的函数
                success: (data) => {
                    let re = /\d/;  //  匹配数字的正则表达式
                    //  匹配数字
                    if (re.test(data)) {
                        //  把点赞按钮中的点赞数量设置为传回的点赞数量
                        $(this).find('b.agree-num').html(data);
                        Toastify({
                            text: "点赞成功！",
                            duration: 3000
                        }).showToast();
                        $(this).get(0).setAttribute('class', 'post-like active')
                    }
                },
                error: (data) => {
                    $(this).get(0).setAttribute('class', 'post-like')
                    Toastify({
                        text: data,
                        duration: 3000,
                        backgroundColor: "linear-gradient(to right, #fa709a 0%, #fee140 100%)"
                    }).showToast();
                },
            });
        })
    },
    addEmoji : ()=>{
        let owo = $(".OwO");
        if(owo.length > 0) {
            new OwO({
                logo: 'OωO',
                container: document.getElementsByClassName('OwO')[0],
                target: document.getElementsByClassName('owo-textarea')[0],
                api: config['owo'],
                position: 'down',
                width: '100%',
                maxHeight: '250px'
            });
            $(document).on('click', function () {
                $('.OwO').removeClass('OwO-open');
            });
        }
    },
    addHighLight : function (){
        hljs.highlightAll();
    },
    addCatalog : ()=>{
        //生成文章目录
        let index = 0;
        let depth = 0;
        let tocTreeHtml = '';
        let tocTreeObj = document.getElementById('tocTree')
        let postContentObj = document.getElementsByTagName('main')[0].querySelector('.article-content');
        postContentObj.innerHTML = postContentObj.innerHTML.replace(/<h([1-6])(.*?)>(.*?)<\/h\1>/ig, function (match, num, attrs, html) {
            index++;

            if (depth < num) {
                if (index > 1) {
                    tocTreeHtml += '</li><li><ul class="article-catalog-list"><li><a href="#index-' + index + '">' + html + '</a>';
                } else {
                    tocTreeHtml += '<li><a href="#index-' + index + '">' + html + '</a>';
                }
            } else if (depth === num) {
                tocTreeHtml += '</li><li><a href="#index-' + index + '">' + html + '</a>';
            } else if (depth > num) {
                tocTreeHtml += '</li>' + (new Array(depth - num + 1).join('</ul></li>')) + '<li><a href="#index-' + index + '">' + html + '</a>';
            }
            depth = num;
            return '<h' + num + attrs + ' id="index-' + (index) + '">' + html + '</h' + num + '>';
        })

        if (tocTreeHtml) {
            tocTreeObj.classList.add('on');
            tocTreeObj.querySelector('.article-catalog-list').innerHTML = tocTreeHtml;
        }
        // 关闭
        document.getElementById('catalog-close').addEventListener('click',
            function() {
                document.getElementById('tocTree').classList.remove('on');
            });
    },
    addComment : ()=> {
        $('#comment-form').on('submit', function (e) {
            e.preventDefault();
            if ($('#comment-respond-author').val().trim() === '') {
                return Toastify({
                    text: '请输入您的昵称！',
                    backgroundColor: "#a7535a",
                    className: "warning",
                }).showToast();
            }
            if (!/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/.test($('#comment-respond-mail').val())) {
                return Toastify({
                    text: '请输入正确的邮箱！',
                    backgroundColor: "#c04851",
                    className: "warning",
                }).showToast();
            }
            if ($('#comment-respond-textarea').val().trim() === '') {
                return Toastify({
                    text: '请输入评论内容！',
                    backgroundColor: "#ed5a65",
                    className: "warning",
                }).showToast();
            }
            if ($(this).attr('data-disabled')) return;
            $(this).attr('data-disabled', true);
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: $(this).serializeArray(),
                success: res => {
                    let url = location.href;
                    Toastify({
                        text: '发送成功!',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        className: "success",
                    }).showToast();
                    setTimeout(function () {
                        window.location.href = url;
                    }, 1500);
                }
            });
        });
    },
    addPageLike: ()=>{
        // 文章点赞
        $('#agree-btn').on('click', function () {
            if ($(this).get(0).getAttribute('data-agree') === '1')
                return Toastify({
                    text: '你已经点赞过了，不给取消！',
                    duration: 3000,
                    backgroundColor: "linear-gradient(to right, #fa709a 0%, #fee140 100%)"
                }).showToast();
            //  发送 AJAX 请求
            $.ajax({
                //  请求方式 post
                type: 'post',
                //  url 获取点赞按钮的自定义 url 属性
                //  发送的数据 cid，直接获取点赞按钮的 cid 属性
                data: 'agree=' + $(this).attr('data-cid'),
                async: true,
                timeout: 30000,
                cache: false,
                //  请求成功的函数
                success: data => {
                    let re = /\d/;  //  匹配数字的正则表达式
                    //  匹配数字
                    if (re.test(data)) {
                        //  把点赞按钮中的点赞数量设置为传回的点赞数量
                        $('#agree-btn .agree-num').html(data);
                        Toastify({
                            text: "点赞成功！",
                            duration: 3000
                        }).showToast();
                    }
                    $(this).get(0).setAttribute('data-agree', '1');
                },
                error: () => {
                    //  如果请求出错就恢复点赞按钮
                    $(this).get(0).setAttribute('data-agree', '0');
                },
            });
        });
    },
    addProcess: () => {
        let calcProgress = () => {
            let scrollTop = $(window).scrollTop();
            let documentHeight = $(document).height();
            let windowHeight = $(window).height();
            let progress = parseInt((scrollTop / (documentHeight - windowHeight)) * 100);
            if (progress < 0) progress = 0;
            if (progress > 100) progress = 100;
            $('#progress').css('width', progress + '%');
        };
        $(window).on('scroll', () => calcProgress());
    },
    addArchiveToggle: () => {
        $('.article-archives .panel').first().next().slideToggle(0);
        $('.article-archives .panel').on('click', function () {
            let next = $(this).next();
            next.slideToggle(200);
            $('.article-archives .panel-body').not(next).slideUp();
        });
    },
    addCoupleTime: () => {
        function secondToDate(second) {
            if (!second) {
                return 0;
            }
            const time = [0, 0, 0, 0, 0];
            if (second >= 365 * 24 * 3600) {
                time[0] = parseInt(second / (365 * 24 * 3600));
                second %= 365 * 24 * 3600;
            }
            if (second >= 24 * 3600) {
                time[1] = parseInt(second / (24 * 3600));
                second %= 24 * 3600;
            }
            if (second >= 3600) {
                time[2] = parseInt(second / 3600);
                second %= 3600;
            }
            if (second >= 60) {
                time[3] = parseInt(second / 60);
                second %= 60;
            }
            if (second > 0) {
                time[4] = second;
            }
            return time;
        }

        function setTime() {
            const startTime = document.getElementById('our-company').getAttribute('data-start');
            let create_time = Math.round(new Date(startTime).getTime() / 1000);
            let timestamp = Math.round((new Date().getTime() + 8 * 60 * 60 * 1000) / 1000);
            let currentTime = secondToDate((timestamp - create_time));
            document.getElementById('our-company').innerHTML = '<span>' + currentTime[0] + '</span>' + '<svg class="icon" aria-hidden="true">\n' +
                '<use xlink:href="#icon-huaban"></use>' +
                '</svg><span>' + currentTime[1] + '</span><svg class="icon" aria-hidden="true">' +
                '<use xlink:href="#icon-tian"></use>' +
                '</svg><span>'
                + currentTime[2] + '</span><svg class="icon" aria-hidden="true">' +
                '<use xlink:href="#icon-shi"></use>' +
                '</svg><span>' + currentTime[3] + '</span><svg class="icon" aria-hidden="true">' +
                '<use xlink:href="#icon-fen"></use>' +
                '</svg><span>' + currentTime[4]
                + '</span><svg class="icon" aria-hidden="true">' +
                '<use xlink:href="#icon-miao"></use>' +
                '</svg>';
        }

        setInterval(setTime, 1000);
    },
    addPostProtect: () => {
        $('.protected-btn').click(function () {
            let surl = $(".protected").attr("action");
            $.ajax({
                type: "POST",
                url: surl,
                data: $('.protected').serialize(),
                error: function (request) {
                    return Toastify({
                        text: '密码提交失败，请刷新页面重试！',
                        duration: 3000,
                        backgroundColor: "#c02c38"
                    }).showToast();
                },
                success: function (data) {

                    if (data.indexOf("密码错误") >= 0 && data.indexOf("<title>Error</title>") >= 0) {
                        return Toastify({
                            text: '密码错误，请重试！',
                            duration: 3000,
                            backgroundColor: "#c02c38"
                        }).showToast();
                    } else {
                        location.reload();
                    }
                }
            });
        });
    },
    addCommentSecret: () => {
        let holder = $('.comment-respond textarea').attr('placeholder');
        $('#secret-button').click(function () {
            let textareaDom = $('.comment-respond textarea');
            if ($(this).is(':checked')) {
                textareaDom.attr('placeholder', '私密回复中')
            } else {
                textareaDom.attr('placeholder', holder)
            }
        })
    },
    addInitTabs: () => {
        $('.article-tabs .nav span').on('click', function () {
            let panel = $(this).attr('data-panel');
            $(this).addClass('active').siblings().removeClass('active');
            $(this).parents('.article-tabs').find('.content div').hide();
            $(this)
                .parents('.article-tabs')
                .find('.content div[data-panel=' + panel + ']')
                .show();
        });
    },
    addInitCollapse: () => {
        $('.article-collapse .collapse-head').on('click', function () {
            let next = $(this).next();
            next.slideToggle(200);
            $('.article-collapse .collapse-body').not(next).slideUp();
        });
    },
    addCarouselEnter(){
        $('#carouselCaptions').on('mouseenter',function (){
           $(this).children('a').css({'display':'flex'})
        })
        $('#carouselCaptions').on('mouseleave',function (){
            $(this).children('a').hide()
        })
    },
    addMorePages(){
        $('.next').click(function() {
            $this = $(this);
            $(this).addClass('loading').text('正在努力加载');
            let href =$(this).attr('href');
            if (href != undefined) {
                $.ajax({
                    url: href,
                    type: 'get',
                    success: function(data) { //请求成功
                        $this.removeClass('loading').text('查看更多');
                        var $res = $(data).find('.article-list');
                        $('.artices').append($res.fadeIn(500));
                        let newhref = $(data).find('.next').attr('href');
                        if (newhref != undefined) {
                            $('.next').attr('href', newhref);
                        } else {
                            $('.next').remove(); //如果没有下一页了，隐藏
                        }
                    }
                });
            }
            return false;
        });
    }
}