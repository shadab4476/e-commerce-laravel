var cursor = document.getElementsByClassName("cursor_custom")
var body = document.getElementById("body");
function cursorMove() {
    body.addEventListener("mousemove", (prop) => {
        gsap.to(cursor, {
            x: prop.x,
            y: prop.y,
            duration: .5
        });
    });
}
cursorMove();
// cursor moved End

// headers
gsap.from(".menu_parent ul li,.navbar .logo,.icon_parent ul li,.main_parent h1,.main_parent h3,.reminder_btn ", {
    y: "-100px",
    opacity: 0,
    duration: 1,
    delay: .5,
    stagger: .1,
})

// shop page
gsap.from(".parent_product_wrapper ul li", {
    opacity: 0,
    duration: 1,
    y: "-150px",
})
// footer
gsap.from(".footer", {
    y: "-60px",
    opacity: 0,
    duration: 0.5,
    scrollTrigger: {
        trigger: ".footer",
        scroller: "body",
        start: "top 100%",
        end: "top 100%",
        scrub: 4
    },
})
// footer
gsap.from(".footer p,.footer ul li", {
    scrollTrigger: {
        trigger: ".footer",
        scroller: "body",
        start: "top 100%",
        end: "top 100%",
        scrub: 1
    },
    y: "-80px",
    duration: 0.5,
    stagger: 0.5,
})
// product view 
gsap.from(".img_view_parent", {
    x: "-500",
    duration: 1,
})
// product view 
gsap.from(".product_detail.main_all_pro_detail", {
    x: "500",
    duration: 1,
})
// product view 
gsap.from(".related_product_wrapper", {
    scrollTrigger: {
        trigger: ".related_product_wrapper",
        scroll: "body",
        start: "top 90%",
        end: "bottom 110%",
        scrub: 1,
    },
    x: "-100%",
});
// cart price detail
gsap.from(".cart_price_detail,.checkout_cnf", {
    rotate: "-150deg",
    scale: "0",
    delay: 1,
    opacity: 0,
    duration: 1,
});
// first page animation for man product image
gsap.from(".offer_details_latest_img", {
    scrollTrigger: {
        scroll: "body",
        trigger: ".section_two",
        scrub: 1,
        start: "top 90%",
        end: "bottom 120%",
    },
    rotate: "-150deg",
    scale: "0",
});
// first page animation for man product detail with timeline Start
gsap.from(".offer_details_latest .discount_upto", {
    scrollTrigger: {
        trigger: ".section_two",
        scroll: "body",
        scrub: 1,
        start: "top 70%",
        end: "bottom 120%",
    },
    rotate: "150deg",
    opacity: "0",
    x: "-200%",
});
// ^^^^^^^^^^^
gsap.from(".offer_details_latest h2", {
    scrollTrigger: {
        trigger: ".section_two",
        scroll: "body",
        scrub: 1,
        start: "top 70%",
        end: "bottom 120%",
    },
    rotate: "150deg",
    opacity: "0",
    x: "-100%",

});
// ^^^^^^^^^^^
gsap.from(".offer_details_latest p", {
    scrollTrigger: {
        trigger: ".section_two",
        scroll: "body",
        scrub: 1,
        start: "bottom 130%",
        end: "bottom 130%",
    },
    opacity: "0",
    y: "100%",
});
// ^^^^^^^^^^^
gsap.from(".offer_details_latest a", {
    scrollTrigger: {
        trigger: ".section_two",
        scroll: "body",
        scrub: 1,
        start: "bottom 130%",
        end: "bottom 130%",
    },
    opacity: "0",
    x: "-100%",
});
// first page animation for man product detail with timeline End


// contect page

gsap.from(".personalDetail", {
    x: "-120%",
    delay: 1,
    deration: 1,
});


gsap.from(".ContectMessageForm", {
    x: "120%",
    delay: 1,
    deration: 1,
});