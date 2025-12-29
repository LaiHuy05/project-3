// phần navigation khi cuộn trang
const nav = document.querySelector(".navigation");

// window : cửa sổ trình duyệt
// document : nội dung html trong cửa sổ đó
// sự kiện scroll cho window lắng nghe sự kiện cho toàn bộ trình duyệt
window.addEventListener("scroll", function () {
  // trang cuộn được gán bằng số pixel đã được cuộn theo trục dọc
  let trangCuon = window.scrollY;
  // số pixel được cuộn lớn hơn 20px thì
  if (trangCuon > 20) {
    nav.classList.add("scrolled");
  } else {
    nav.classList.remove("scrolled");
  }
});

// phần xem thêm và ẩn bớt

// phần tìm kiếm
