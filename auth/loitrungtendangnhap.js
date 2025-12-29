let tenDangNhap = document.querySelector("#name");
let dangKy = document.querySelector("#sigup");
dangKy.addEventListener("submit", function () {
  tenDangNhap.value = "/* Ten Dang Nhap da ton tai */";
  tenDangNhap.style.color = "red";
});
