//HIDE ALL PRODUCTS
$(document).ready(function(){
  $('#iframe').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
  $('#iframe-cart').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
  $('#iframe-cart-desktop').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
    $('#iframe-store-orders').click(function(){
    $('.category-top-section-container-outer').hide();
    })
    });
  $(document).ready(function(){
      $('#iframe-all-orders').click(function(){
      $('.category-top-section-container-outer').hide();
      })
      });  
  $(document).ready(function(){
  $('#iframe-cart-mobile').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
  $('#iframe-about-anchorindex').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
  $('#iframe-about').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
  $('#iframe-account').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
  $('#iframe-account-anchorindex').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
  $('#iframe-feedback').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
  $('#iframe-mystore').click(function(){
  $('.category-top-section-container-outer').hide();
  })
  });
  $(document).ready(function(){
  $('#iframe-store-help').click(function(){
    $('.category-top-section-container-outer').hide();
    })
  }); 
  $(document).ready(function(){
    $('#iframe-help').click(function(){
      $('.category-top-section-container-outer').hide();
      })
    });  
  $(document).ready(function(){
  $('#iframe-management').click(function(){
    $('.category-top-section-container-outer').hide();
    })
  });
  $(document).ready(function(){
    $('#iframe-sell').click(function(){
      $('.category-top-section-container-outer').hide();
      })
    });
  $(document).ready(function(){
    $('#iframe-wishlist').click(function(){
      $('.category-top-section-container-outer').hide();
      })
    });
  $(document).ready(function(){
    $('#iframe-login').click(function(){
      $('.category-top-section-container-outer').hide();
      })
    });
  $(document).ready(function(){
    $('#iframe-privacy').click(function(){
      $('.category-top-section-container-outer').hide();
      })
    });
    $(document).ready(function(){
      $('#iframe-orders').click(function(){
        $('.category-top-section-container-outer').hide();
        })
      });
    $(document).ready(function(){
      $('#iframe-privacy-footer').click(function(){
        $('.category-top-section-container-outer').hide();
        })
      });
      $(document).ready(function(){
        $('#iframe-about-footer').click(function(){
          $('.category-top-section-container-outer').hide();
          })
        });
  $(document).ready(function(){
    $('.productImg-link').click(function(){
      $('.category-top-section-container-outer').hide();
      })
    });
  
    $(document).ready(function(){
      $('#iframe-terms').click(function(){
        $('.category-top-section-container-outer').hide();
        })
      });
  
  $(document).ready(function(){
        $('#iframe-all-chats').click(function(){
          $('.category-top-section-container-outer').hide();
          })
        });

    $(document).ready(function(){
      $('.product-company').click(function(){
        $('.category-top-section-container-outer').hide();
        })
      })
   $(document).ready(function(){
        $('#iframe-login-notify').click(function(){
          $('.category-top-section-container-outer').hide();
          })
        });   
  $(document).ready(function(){
          $('#iframe-login-message').click(function(){
            $('.category-top-section-container-outer').hide();
            })
          });  

//hide reviews
$(document).ready(function(){
  $('.review-button').click(function(){
    $(this).next('.comments-container').slideToggle();
    $(this).toggleClass('active');
    })
}); 
  $(document).click(function (e) {
    var container = $('.review-button');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('.comments-container').hide();
    }
});

//AUTHOPTIONS MAIN DROPPER
$(document).ready(function(){
    $('#dropper1').click(function(){
      $(this).next('#dropdownMainLogin-content').slideToggle();
      $(this).toggleClass('active');
      })
  });  
  $(document).click(function (e) {
    var container = $('#dropper1');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        $('#dropdownMainLogin-content').hide();
    }
});


 $(document).ready(function(){
    $('#dropper2').click(function(){
      $(this).next('#dropdownMainSignup-content').slideToggle();
      $(this).toggleClass('active');
      })
  });
$(document).click(function (e) {
  var container = $('#dropper2');
  if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('#dropdownMainSignup-content').hide();
  }
});

  $(document).ready(function () {
    $("#dropper3").hover(function () {
      $(this).next('#dropdownRegion-content').slideToggle();
      $(this).toggleClass('active');
    }, function () {
    });
});
// $(document).ready(function(){
//     $('#dropper3').hover(function(){
//       $(this).next('#dropdownRegion-content').slideToggle();
//       $(this).toggleClass('active');
//       }) 
//   });

$(document).click(function (e) {
      $('#dropdownRegion-content').hide();
});

$(document).ready(function () {
  $("#dropper4").hover(function () {
    $(this).next('#dropdownCategory-content').slideToggle();
    $(this).toggleClass('active');
  }, function () {
  });
});

// $(document).ready(function(){
//     $('#dropper4').hover(function(){
//       $(this).next('#dropdownCategory-content').slideToggle();
//       $(this).toggleClass('active');
//       })
//   });

$(document).click(function (e) {
      $('#dropdownCategory-content').hide();
});

$(document).ready(function(){
  $('#dropper-one').click(function(){
    $(this).next('#dropdownMain-content-second').slideToggle();
    $(this).toggleClass('active');
    })
});  
$(document).click(function (e) {
  var container = $('#dropper-one');
  if (!container.is(e.target) && container.has(e.target).length === 0) {
      $('#dropdownMain-content-second').hide();
  }
});

//AUTHOPTIONS SECOND
$(document).ready(function(){
  $('#dropper-two').click(function(){
    $(this).next('#dropdownMainSignup-content-second').slideToggle();
    $(this).toggleClass('active');
    })
});
$(document).click(function (e) {
var container = $('#dropper-two');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownMainSignup-content-second').hide();
}
});

$(document).ready(function(){
  $('#dropper-three').click(function(){
    $(this).next('#dropdownRegion-content-second').slideToggle();
    $(this).toggleClass('active');
    })
});
$(document).click(function (e) {
var container = $('#dropper-three');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownRegion-content-second').hide();
}
});



$(document).ready(function(){
  $('#dropper-four').click(function(){
    $(this).next('#dropdownCategory-content-second').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).click(function (e) {
var container = $('#dropper-four');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownCategory-content-second').hide();
}
});
//DROPPER AUTHOPTIONS TOP
$(document).ready(function(){
  $('#dropper-three-mobile').click(function(){
    $(this).next('#dropdownRegion-content-mobile').slideToggle();
    $(this).toggleClass('active');
    })
});
$(document).click(function (e) {
var container = $('#dropper-three-mobile');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownRegion-content-mobile').hide();
}
});



$(document).ready(function(){
  $('#dropper-four-mobile').click(function(){
    $(this).next('#dropdownCategory-content-mobile').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).click(function (e) {
var container = $('#dropper-four-mobile');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('#dropdownCategory-content-mobile').hide();
}
});

//NOTIFICATION MESSAGES DROPDOWN

$(document).ready(function(){
  $('.notification-dropdown').click(function(){
    $(this).next('.dropdownNotification').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).click(function (e) {
var container = $('.notification-dropdown');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('.dropdownNotification').hide();
}
});

$(document).ready(function(){
  $('.dropdown').click(function(){
    $(this).next('.dropdown-content').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).click(function (e) {
var container = $('.dropdown');
if (!container.is(e.target) && container.has(e.target).length === 0) {
    $('.dropdown-content').hide();
}
});

//AUTHOPTIONS DROPPER
$(document).ready(function(){
  $('#topdropper').click(function(){
    $(this).next('.authoptions').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).ready(function(){
  $('.authoptions-remover').click(function(){
    $('.authoptions').hide();
    })
});
$(document).ready(function(){
  $('.authoptions-grey-area').click(function(){
    $('.authoptions').hide();
    })
});
//SECOND AUTHOPTONS DROPPER
$(document).ready(function(){
  $('#topdropper2').click(function(){
    $(this).next('.authoptions').slideToggle();
    $(this).toggleClass('active');
    })
});

$(document).ready(function(){
  $('.authoptions-remover').click(function(){
    $('.authoptions').hide();
    })
});