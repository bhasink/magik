(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["styles"],{

/***/ "./node_modules/@angular-devkit/build-angular/src/angular-cli-files/plugins/raw-css-loader.js!./node_modules/postcss-loader/src/index.js?!./src/styles.css":
/*!*****************************************************************************************************************************************************************!*\
  !*** ./node_modules/@angular-devkit/build-angular/src/angular-cli-files/plugins/raw-css-loader.js!./node_modules/postcss-loader/src??embedded!./src/styles.css ***!
  \*****************************************************************************************************************************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = [[module.i, "@charset \"utf-8\";\n/* CSS Document */\n* {\n  padding: 0;\n  margin: 0;\n  box-sizing: border-box;\n}\nli {\n  list-style: none;\n}\na {\n  color: #000;\n  text-decoration: none;\n}\nbody {\n  margin: 0px;\n  padding: 0px;\n  line-height: 16px;\n  font-family:  sans-serif; \n  font-size: 14px;\n  overflow-x: hidden;\n}\n.header{\n    width: 100%;\n}\n.container{\n    width: 400px;\n    margin: 0 auto;\n}\n.logo {\n\tmargin: 0 auto;\n\twidth: 210px;\n\tmargin: 10px auto 15px;\n}\n.was-validated .form-control:invalid, .form-control.is-invalid {\n\tborder-color: #dc3545;\t\n}\n.invalid-feedback {\n\tcolor: #dc3545;\n}\n.thanks-msg {\n\ttext-align: center;\n\tfont-size: 29px;\n}\nbody {\n\tbackground: #124363;\n\tborder-top: 10px solid #e93b83;\n}\n.scratch-container {  \n  width:100%;\n}\n.promo-container {\n\tbackground:#FFF;\n\tborder-radius:5px;\n\t-moz-border-radius:5px;\n\t-webkit-border-radius:5px;\n\twidth:450px;\n\tpadding:20px;\n\tmargin:0 auto;\n\ttext-align:center;\n\tfont-family:'Open Sans', Arial,Sans-serif;\n\tcolor:#333;\n\tfont-size:16px;\n\tmargin-top:20px;\n}\n.btn {\n  background:#56CFD2;\n  color:#FFF;\n  padding:10px 25px;\n  display:inline-block;\n  margin-top:15px;\n  text-decoration:none;\n  font-weight:600;\n  text-transform:uppercase;\n  border-radius:3px;\n  -moz-border-radius:3px;\n  -webkit-border-radiuss:3px;\n}\n.scr {\n\tbackground: #114363;\n\tmax-width: 400px;\n\twidth: 100%;\n\tmargin: 0 auto;\n}\n.scrap-wrap{\n  width: 100%;\n  background: url('scratch-bg.jpg') 0 0 no-repeat;\n  padding: 25px 0;\n}\n.scratchpad{\n  width: 332px;\n  margin: 0 auto;\n  height: 245px;\n  border-radius:10px;\n  overflow: hidden; \n  \n}\n.btn {\n\tbackground: #da4182;\n\tcolor: #FFF;\n\tpadding: 10px 25px;\n\tdisplay: inline-block;\n\tmargin-top: 15px;\n\ttext-decoration: none;\n\tfont-weight: 600;\n\ttext-transform: uppercase;\n\tborder-radius: 3px;\n\t-moz-border-radius: 3px;\n\t-webkit-border-radiuss: 3px;\n\tborder-color: #da4182;\n\twidth: 100%;\n}\n.loader {\n\tposition: fixed;\n\ttop: 0;\n\tleft: 0;\n\tbackground: #ecf0f1;\n\twidth: 100%;\n\theight: 100%;\n}\n.loader img {\n\tposition: absolute;\n\ttop: 0;\n\tbottom: 0;\n\twidth: 183px;\n\theight: 166px;\n\tright: 0;\n\tbottom: 0;\n\tmargin: auto;\n\tleft: 0;\n}\n.service-error {\n\tfont-size: 25px;\n\twidth: 100%;\n\tline-height: normal;\n\ttext-align: center;\n\tpadding-top: 87px;\n\tpadding-bottom: 87px;\n}\n.heading{\n\tfont-size: 18px;\n\twidth: 100%;\n\tline-height: normal;\n\tpadding-bottom: 28px;\n}\n.flex{\n  display: flex;\n  flex-wrap: wrap;\n  justify-content: space-between;\n}\n.term-cond {\n\tcolor: #fff;\n\tfont-size: 12px;\n\ttext-decoration: underline;\n\tcursor: pointer;\n}\n.social {\n\tpadding: 10px 15px;\n}\n.footer {\n\tbackground: #ec3e89;\n\tcolor: #fff;\n\tpadding: 10px 15px 0;\n\tfont-size: 13px;\n}\n.term-cond-data , .fin-suc {\n\tposition: fixed;\n\ttop: 0;\n\twidth: 100%;\n\tmax-width: 400px;\n\tbackground: #114364;\n\theight: 100%;\n\tcolor: #fff;\n\tpadding: 23px;\n\tdisplay: flex;\n\tline-height: 22px;\n}\n.soc-link ul li{ display: inline-block;  margin-right: 2px;}\n.term-cond-data-inside{\n  align-self: center;\n}\n.term-cond-data-inside li{\n\tmargin-bottom: 8px;\n}\n.term-cond-data-close {\n\tfont-size: 20px;\n\tposition: absolute;\n\tright: 46px;\n\tcursor: pointer;\n}\n.white-bg {\n\tbackground: #fff;\n\tpadding: 33px;\n\tbox-sizing: border-box;\n\tborder-radius: 16px; \n\tpadding-bottom: 10px;\n}\n.form-control[name=\"outlet_name\"] , .form-control[name=\"city\"]{\n\tbackground: url('out-icon.png') 98% no-repeat;\n}\n.form-control[name=\"name\"]{\nbackground: url('name-icon.png') 98% no-repeat;\n}\n.form-control[name=\"mobile\"]{\nbackground: url('mobile-icon.png') 98% no-repeat;\n}\n.form-control[name=\"email\"]{\nbackground: url('email-icon.png') 98% no-repeat;\n}\n.form-control[name=\"distributor_name\"]{\nbackground: url('dist-icon.png') 98% no-repeat;\n}\n.form-control[name=\"state_id\"]{\nbackground: url('city-icon.png') 98% no-repeat;\n-webkit-appearance: none;\n-moz-appearance:    none;\nappearance:         none;\n}\n.form-control {\n\tbackground-color: #f2f2f2 !important;\t\n\tborder-left: 3px solid #52b038;\n\tborder-radius: 0;\n}\n.form-group {\n\tmargin-bottom: 18px;\n}\n.footer-home {\n\t/* background: #002339; */\n\tcolor: #fff;\n\ttext-align: center;\n\tpadding: 10px 0;\n\tfont-size: 12px;\n\tmargin-top: 19px;\n}\n.fin-suc-inside {\n\ttext-align: center;\n\tpadding-top: 0;\n\tcolor: #fff;\n\tpadding-bottom: 16px;\n\tdisplay: none;\n}\n.fin-suc-inside a{\n\tcolor:#fff;\n\ttext-decoration: underline;\n\tmargin-top: 0px;\n\tdisplay: inline-block;\n}\n.fin-suc{\n\tdisplay: none;\n}\n/* Extra Small Devices, Phones */\n@media only screen and (max-width : 480px) {\n    .container{\n      width: 96%;\n    }\n    .scr img{\n      width: 100%;\n    }\n    .scratchpad {    width: 96%;\n      height: 245px;\n      margin: 0 auto;}\n    .scratch-container {width:100%;}\n  }\n/* Custom, iPhone Retina */\n@media only screen and (max-width : 320px) {\n    .scratchpad {width:290px;height:230px;}\n    \n  }\n/*# sourceMappingURL=data:application/json;base64,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O0NBQ0Msa0JBQWtCO0FBQ25CO0FBQ0E7Q0FDQyxlQUFlO0NBQ2Ysa0JBQWtCO0NBQ2xCLFdBQVc7Q0FDWCxlQUFlO0FBQ2hCO0FBQ0E7Q0FDQyxnQkFBZ0I7Q0FDaEIsYUFBYTtDQUNiLHNCQUFzQjtDQUN0QixtQkFBbUI7Q0FDbkIsb0JBQW9CO0FBQ3JCO0FBQ0E7Q0FDQyw2Q0FBeUQ7QUFDMUQ7QUFDQTtBQUNBLDhDQUEwRDtBQUMxRDtBQUNBO0FBQ0EsZ0RBQTREO0FBQzVEO0FBQ0E7QUFDQSwrQ0FBMkQ7QUFDM0Q7QUFDQTtBQUNBLDhDQUEwRDtBQUMxRDtBQUNBO0FBQ0EsOENBQTBEO0FBQzFELHdCQUF3QjtBQUN4Qix3QkFBd0I7QUFDeEIsd0JBQXdCO0FBQ3hCO0FBQ0E7Q0FDQyxvQ0FBb0M7Q0FDcEMsOEJBQThCO0NBQzlCLGdCQUFnQjtBQUNqQjtBQUNBO0NBQ0MsbUJBQW1CO0FBQ3BCO0FBQ0E7Q0FDQyx5QkFBeUI7Q0FDekIsV0FBVztDQUNYLGtCQUFrQjtDQUNsQixlQUFlO0NBQ2YsZUFBZTtDQUNmLGdCQUFnQjtBQUNqQjtBQUNBO0NBQ0Msa0JBQWtCO0NBQ2xCLGNBQWM7Q0FDZCxXQUFXO0NBQ1gsb0JBQW9CO0NBQ3BCLGFBQWE7QUFDZDtBQUNBO0NBQ0MsVUFBVTtDQUNWLDBCQUEwQjtDQUMxQixlQUFlO0NBQ2YscUJBQXFCO0FBQ3RCO0FBQ0E7Q0FDQyxhQUFhO0FBQ2Q7QUFRRSxnQ0FBZ0M7QUFDaEM7SUFDRTtNQUNFLFVBQVU7SUFDWjtJQUNBO01BQ0UsV0FBVztJQUNiO0lBQ0EsaUJBQWlCLFVBQVU7TUFDekIsYUFBYTtNQUNiLGNBQWMsQ0FBQztJQUNqQixvQkFBb0IsVUFBVSxDQUFDO0VBQ2pDO0FBRUEsMEJBQTBCO0FBQzFCO0lBQ0UsYUFBYSxXQUFXLENBQUMsWUFBWSxDQUFDOztFQUV4QyIsImZpbGUiOiJzcmMvc3R5bGVzLmNzcyIsInNvdXJjZXNDb250ZW50IjpbIkBjaGFyc2V0IFwidXRmLThcIjtcbi8qIENTUyBEb2N1bWVudCAqL1xuKiB7XG4gIHBhZGRpbmc6IDA7XG4gIG1hcmdpbjogMDtcbiAgYm94LXNpemluZzogYm9yZGVyLWJveDtcbn1cbmxpIHtcbiAgbGlzdC1zdHlsZTogbm9uZTtcbn1cbmEge1xuICBjb2xvcjogIzAwMDtcbiAgdGV4dC1kZWNvcmF0aW9uOiBub25lO1xufVxuYm9keSB7XG4gIG1hcmdpbjogMHB4O1xuICBwYWRkaW5nOiAwcHg7XG4gIGxpbmUtaGVpZ2h0OiAxNnB4O1xuICBmb250LWZhbWlseTogIHNhbnMtc2VyaWY7IFxuICBmb250LXNpemU6IDE0cHg7XG4gIG92ZXJmbG93LXg6IGhpZGRlbjtcbn1cblxuLmhlYWRlcntcbiAgICB3aWR0aDogMTAwJTtcbn1cbi5jb250YWluZXJ7XG4gICAgd2lkdGg6IDQwMHB4O1xuICAgIG1hcmdpbjogMCBhdXRvO1xufVxuLmxvZ28ge1xuXHRtYXJnaW46IDAgYXV0bztcblx0d2lkdGg6IDIxMHB4O1xuXHRtYXJnaW46IDEwcHggYXV0byAxNXB4O1xufVxuLndhcy12YWxpZGF0ZWQgLmZvcm0tY29udHJvbDppbnZhbGlkLCAuZm9ybS1jb250cm9sLmlzLWludmFsaWQge1xuXHRib3JkZXItY29sb3I6ICNkYzM1NDU7XHRcbn1cbi5pbnZhbGlkLWZlZWRiYWNrIHtcblx0Y29sb3I6ICNkYzM1NDU7XG59XG4udGhhbmtzLW1zZyB7XG5cdHRleHQtYWxpZ246IGNlbnRlcjtcblx0Zm9udC1zaXplOiAyOXB4O1xufVxuXG5ib2R5IHtcblx0YmFja2dyb3VuZDogIzEyNDM2Mztcblx0Ym9yZGVyLXRvcDogMTBweCBzb2xpZCAjZTkzYjgzO1xufVxuLnNjcmF0Y2gtY29udGFpbmVyIHsgIFxuICB3aWR0aDoxMDAlO1xufVxuXG4ucHJvbW8tY29udGFpbmVyIHtcblx0YmFja2dyb3VuZDojRkZGO1xuXHRib3JkZXItcmFkaXVzOjVweDtcblx0LW1vei1ib3JkZXItcmFkaXVzOjVweDtcblx0LXdlYmtpdC1ib3JkZXItcmFkaXVzOjVweDtcblx0d2lkdGg6NDUwcHg7XG5cdHBhZGRpbmc6MjBweDtcblx0bWFyZ2luOjAgYXV0bztcblx0dGV4dC1hbGlnbjpjZW50ZXI7XG5cdGZvbnQtZmFtaWx5OidPcGVuIFNhbnMnLCBBcmlhbCxTYW5zLXNlcmlmO1xuXHRjb2xvcjojMzMzO1xuXHRmb250LXNpemU6MTZweDtcblx0bWFyZ2luLXRvcDoyMHB4O1xufVxuLmJ0biB7XG4gIGJhY2tncm91bmQ6IzU2Q0ZEMjtcbiAgY29sb3I6I0ZGRjtcbiAgcGFkZGluZzoxMHB4IDI1cHg7XG4gIGRpc3BsYXk6aW5saW5lLWJsb2NrO1xuICBtYXJnaW4tdG9wOjE1cHg7XG4gIHRleHQtZGVjb3JhdGlvbjpub25lO1xuICBmb250LXdlaWdodDo2MDA7XG4gIHRleHQtdHJhbnNmb3JtOnVwcGVyY2FzZTtcbiAgYm9yZGVyLXJhZGl1czozcHg7XG4gIC1tb3otYm9yZGVyLXJhZGl1czozcHg7XG4gIC13ZWJraXQtYm9yZGVyLXJhZGl1c3M6M3B4O1xufVxuLnNjciB7XG5cdGJhY2tncm91bmQ6ICMxMTQzNjM7XG5cdG1heC13aWR0aDogNDAwcHg7XG5cdHdpZHRoOiAxMDAlO1xuXHRtYXJnaW46IDAgYXV0bztcbn1cbi5zY3JhcC13cmFwe1xuICB3aWR0aDogMTAwJTtcbiAgYmFja2dyb3VuZDogdXJsKGFzc2V0cy9pbWFnZXMvc2NyYXRjaC1iZy5qcGcpIDAgMCBuby1yZXBlYXQ7XG4gIHBhZGRpbmc6IDI1cHggMDtcbn1cbi5zY3JhdGNocGFke1xuICB3aWR0aDogMzMycHg7XG4gIG1hcmdpbjogMCBhdXRvO1xuICBoZWlnaHQ6IDI0NXB4O1xuICBib3JkZXItcmFkaXVzOjEwcHg7XG4gIG92ZXJmbG93OiBoaWRkZW47IFxuICBcbn1cbi5idG4ge1xuXHRiYWNrZ3JvdW5kOiAjZGE0MTgyO1xuXHRjb2xvcjogI0ZGRjtcblx0cGFkZGluZzogMTBweCAyNXB4O1xuXHRkaXNwbGF5OiBpbmxpbmUtYmxvY2s7XG5cdG1hcmdpbi10b3A6IDE1cHg7XG5cdHRleHQtZGVjb3JhdGlvbjogbm9uZTtcblx0Zm9udC13ZWlnaHQ6IDYwMDtcblx0dGV4dC10cmFuc2Zvcm06IHVwcGVyY2FzZTtcblx0Ym9yZGVyLXJhZGl1czogM3B4O1xuXHQtbW96LWJvcmRlci1yYWRpdXM6IDNweDtcblx0LXdlYmtpdC1ib3JkZXItcmFkaXVzczogM3B4O1xuXHRib3JkZXItY29sb3I6ICNkYTQxODI7XG5cdHdpZHRoOiAxMDAlO1xufVxuLmxvYWRlciB7XG5cdHBvc2l0aW9uOiBmaXhlZDtcblx0dG9wOiAwO1xuXHRsZWZ0OiAwO1xuXHRiYWNrZ3JvdW5kOiAjZWNmMGYxO1xuXHR3aWR0aDogMTAwJTtcblx0aGVpZ2h0OiAxMDAlO1xufVxuLmxvYWRlciBpbWcge1xuXHRwb3NpdGlvbjogYWJzb2x1dGU7XG5cdHRvcDogMDtcblx0Ym90dG9tOiAwO1xuXHR3aWR0aDogMTgzcHg7XG5cdGhlaWdodDogMTY2cHg7XG5cdHJpZ2h0OiAwO1xuXHRib3R0b206IDA7XG5cdG1hcmdpbjogYXV0bztcblx0bGVmdDogMDtcbn1cbi5zZXJ2aWNlLWVycm9yIHtcblx0Zm9udC1zaXplOiAyNXB4O1xuXHR3aWR0aDogMTAwJTtcblx0bGluZS1oZWlnaHQ6IG5vcm1hbDtcblx0dGV4dC1hbGlnbjogY2VudGVyO1xuXHRwYWRkaW5nLXRvcDogODdweDtcblx0cGFkZGluZy1ib3R0b206IDg3cHg7XG59IFxuLmhlYWRpbmd7XG5cdGZvbnQtc2l6ZTogMThweDtcblx0d2lkdGg6IDEwMCU7XG5cdGxpbmUtaGVpZ2h0OiBub3JtYWw7XG5cdHBhZGRpbmctYm90dG9tOiAyOHB4O1xufVxuLmZsZXh7XG4gIGRpc3BsYXk6IGZsZXg7XG4gIGZsZXgtd3JhcDogd3JhcDtcbiAganVzdGlmeS1jb250ZW50OiBzcGFjZS1iZXR3ZWVuO1xufVxuLnRlcm0tY29uZCB7XG5cdGNvbG9yOiAjZmZmO1xuXHRmb250LXNpemU6IDEycHg7XG5cdHRleHQtZGVjb3JhdGlvbjogdW5kZXJsaW5lO1xuXHRjdXJzb3I6IHBvaW50ZXI7XG59XG4uc29jaWFsIHtcblx0cGFkZGluZzogMTBweCAxNXB4O1xufVxuLmZvb3RlciB7XG5cdGJhY2tncm91bmQ6ICNlYzNlODk7XG5cdGNvbG9yOiAjZmZmO1xuXHRwYWRkaW5nOiAxMHB4IDE1cHggMDtcblx0Zm9udC1zaXplOiAxM3B4O1xufVxuLnRlcm0tY29uZC1kYXRhICwgLmZpbi1zdWMge1xuXHRwb3NpdGlvbjogZml4ZWQ7XG5cdHRvcDogMDtcblx0d2lkdGg6IDEwMCU7XG5cdG1heC13aWR0aDogNDAwcHg7XG5cdGJhY2tncm91bmQ6ICMxMTQzNjQ7XG5cdGhlaWdodDogMTAwJTtcblx0Y29sb3I6ICNmZmY7XG5cdHBhZGRpbmc6IDIzcHg7XG5cdGRpc3BsYXk6IGZsZXg7XG5cdGxpbmUtaGVpZ2h0OiAyMnB4O1xufVxuLnNvYy1saW5rIHVsIGxpeyBkaXNwbGF5OiBpbmxpbmUtYmxvY2s7ICBtYXJnaW4tcmlnaHQ6IDJweDt9XG4udGVybS1jb25kLWRhdGEtaW5zaWRle1xuICBhbGlnbi1zZWxmOiBjZW50ZXI7XG59XG4udGVybS1jb25kLWRhdGEtaW5zaWRlIGxpe1xuXHRtYXJnaW4tYm90dG9tOiA4cHg7XG59XG4udGVybS1jb25kLWRhdGEtY2xvc2Uge1xuXHRmb250LXNpemU6IDIwcHg7XG5cdHBvc2l0aW9uOiBhYnNvbHV0ZTtcblx0cmlnaHQ6IDQ2cHg7XG5cdGN1cnNvcjogcG9pbnRlcjtcbn1cbi53aGl0ZS1iZyB7XG5cdGJhY2tncm91bmQ6ICNmZmY7XG5cdHBhZGRpbmc6IDMzcHg7XG5cdGJveC1zaXppbmc6IGJvcmRlci1ib3g7XG5cdGJvcmRlci1yYWRpdXM6IDE2cHg7IFxuXHRwYWRkaW5nLWJvdHRvbTogMTBweDtcbn1cbi5mb3JtLWNvbnRyb2xbbmFtZT1cIm91dGxldF9uYW1lXCJdICwgLmZvcm0tY29udHJvbFtuYW1lPVwiY2l0eVwiXXtcblx0YmFja2dyb3VuZDogdXJsKGFzc2V0cy9pbWFnZXMvb3V0LWljb24ucG5nKSA5OCUgbm8tcmVwZWF0O1xufVxuLmZvcm0tY29udHJvbFtuYW1lPVwibmFtZVwiXXtcbmJhY2tncm91bmQ6IHVybChhc3NldHMvaW1hZ2VzL25hbWUtaWNvbi5wbmcpIDk4JSBuby1yZXBlYXQ7XG59XG4uZm9ybS1jb250cm9sW25hbWU9XCJtb2JpbGVcIl17XG5iYWNrZ3JvdW5kOiB1cmwoYXNzZXRzL2ltYWdlcy9tb2JpbGUtaWNvbi5wbmcpIDk4JSBuby1yZXBlYXQ7XG59XG4uZm9ybS1jb250cm9sW25hbWU9XCJlbWFpbFwiXXtcbmJhY2tncm91bmQ6IHVybChhc3NldHMvaW1hZ2VzL2VtYWlsLWljb24ucG5nKSA5OCUgbm8tcmVwZWF0O1xufVxuLmZvcm0tY29udHJvbFtuYW1lPVwiZGlzdHJpYnV0b3JfbmFtZVwiXXtcbmJhY2tncm91bmQ6IHVybChhc3NldHMvaW1hZ2VzL2Rpc3QtaWNvbi5wbmcpIDk4JSBuby1yZXBlYXQ7XG59XG4uZm9ybS1jb250cm9sW25hbWU9XCJzdGF0ZV9pZFwiXXtcbmJhY2tncm91bmQ6IHVybChhc3NldHMvaW1hZ2VzL2NpdHktaWNvbi5wbmcpIDk4JSBuby1yZXBlYXQ7XG4td2Via2l0LWFwcGVhcmFuY2U6IG5vbmU7XG4tbW96LWFwcGVhcmFuY2U6ICAgIG5vbmU7XG5hcHBlYXJhbmNlOiAgICAgICAgIG5vbmU7XG59XG4uZm9ybS1jb250cm9sIHtcblx0YmFja2dyb3VuZC1jb2xvcjogI2YyZjJmMiAhaW1wb3J0YW50O1x0XG5cdGJvcmRlci1sZWZ0OiAzcHggc29saWQgIzUyYjAzODtcblx0Ym9yZGVyLXJhZGl1czogMDtcbn1cbi5mb3JtLWdyb3VwIHtcblx0bWFyZ2luLWJvdHRvbTogMThweDtcbn1cbi5mb290ZXItaG9tZSB7XG5cdC8qIGJhY2tncm91bmQ6ICMwMDIzMzk7ICovXG5cdGNvbG9yOiAjZmZmO1xuXHR0ZXh0LWFsaWduOiBjZW50ZXI7XG5cdHBhZGRpbmc6IDEwcHggMDtcblx0Zm9udC1zaXplOiAxMnB4O1xuXHRtYXJnaW4tdG9wOiAxOXB4O1xufVxuLmZpbi1zdWMtaW5zaWRlIHtcblx0dGV4dC1hbGlnbjogY2VudGVyO1xuXHRwYWRkaW5nLXRvcDogMDtcblx0Y29sb3I6ICNmZmY7XG5cdHBhZGRpbmctYm90dG9tOiAxNnB4O1xuXHRkaXNwbGF5OiBub25lO1xufVxuLmZpbi1zdWMtaW5zaWRlIGF7XG5cdGNvbG9yOiNmZmY7XG5cdHRleHQtZGVjb3JhdGlvbjogdW5kZXJsaW5lO1xuXHRtYXJnaW4tdG9wOiAwcHg7XG5cdGRpc3BsYXk6IGlubGluZS1ibG9jaztcbn1cbi5maW4tc3Vje1xuXHRkaXNwbGF5OiBub25lO1xufVxuXG5cblxuXG5cblxuXG4gIC8qIEV4dHJhIFNtYWxsIERldmljZXMsIFBob25lcyAqLyBcbiAgQG1lZGlhIG9ubHkgc2NyZWVuIGFuZCAobWF4LXdpZHRoIDogNDgwcHgpIHtcbiAgICAuY29udGFpbmVye1xuICAgICAgd2lkdGg6IDk2JTtcbiAgICB9XG4gICAgLnNjciBpbWd7XG4gICAgICB3aWR0aDogMTAwJTtcbiAgICB9XG4gICAgLnNjcmF0Y2hwYWQgeyAgICB3aWR0aDogOTYlO1xuICAgICAgaGVpZ2h0OiAyNDVweDtcbiAgICAgIG1hcmdpbjogMCBhdXRvO31cbiAgICAuc2NyYXRjaC1jb250YWluZXIge3dpZHRoOjEwMCU7fVxuICB9XG5cbiAgLyogQ3VzdG9tLCBpUGhvbmUgUmV0aW5hICovIFxuICBAbWVkaWEgb25seSBzY3JlZW4gYW5kIChtYXgtd2lkdGggOiAzMjBweCkge1xuICAgIC5zY3JhdGNocGFkIHt3aWR0aDoyOTBweDtoZWlnaHQ6MjMwcHg7fVxuICAgIFxuICB9Il19 */", '', '']]

/***/ }),

/***/ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js":
/*!****************************************************************************!*\
  !*** ./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js ***!
  \****************************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

"use strict";


var stylesInDom = {};

var isOldIE = function isOldIE() {
  var memo;
  return function memorize() {
    if (typeof memo === 'undefined') {
      // Test for IE <= 9 as proposed by Browserhacks
      // @see http://browserhacks.com/#hack-e71d8692f65334173fee715c222cb805
      // Tests for existence of standard globals is to allow style-loader
      // to operate correctly into non-standard environments
      // @see https://github.com/webpack-contrib/style-loader/issues/177
      memo = Boolean(window && document && document.all && !window.atob);
    }

    return memo;
  };
}();

var getTarget = function getTarget() {
  var memo = {};
  return function memorize(target) {
    if (typeof memo[target] === 'undefined') {
      var styleTarget = document.querySelector(target); // Special case to return head of iframe instead of iframe itself

      if (window.HTMLIFrameElement && styleTarget instanceof window.HTMLIFrameElement) {
        try {
          // This will throw an exception if access to iframe is blocked
          // due to cross-origin restrictions
          styleTarget = styleTarget.contentDocument.head;
        } catch (e) {
          // istanbul ignore next
          styleTarget = null;
        }
      }

      memo[target] = styleTarget;
    }

    return memo[target];
  };
}();

function listToStyles(list, options) {
  var styles = [];
  var newStyles = {};

  for (var i = 0; i < list.length; i++) {
    var item = list[i];
    var id = options.base ? item[0] + options.base : item[0];
    var css = item[1];
    var media = item[2];
    var sourceMap = item[3];
    var part = {
      css: css,
      media: media,
      sourceMap: sourceMap
    };

    if (!newStyles[id]) {
      styles.push(newStyles[id] = {
        id: id,
        parts: [part]
      });
    } else {
      newStyles[id].parts.push(part);
    }
  }

  return styles;
}

function addStylesToDom(styles, options) {
  for (var i = 0; i < styles.length; i++) {
    var item = styles[i];
    var domStyle = stylesInDom[item.id];
    var j = 0;

    if (domStyle) {
      domStyle.refs++;

      for (; j < domStyle.parts.length; j++) {
        domStyle.parts[j](item.parts[j]);
      }

      for (; j < item.parts.length; j++) {
        domStyle.parts.push(addStyle(item.parts[j], options));
      }
    } else {
      var parts = [];

      for (; j < item.parts.length; j++) {
        parts.push(addStyle(item.parts[j], options));
      }

      stylesInDom[item.id] = {
        id: item.id,
        refs: 1,
        parts: parts
      };
    }
  }
}

function insertStyleElement(options) {
  var style = document.createElement('style');

  if (typeof options.attributes.nonce === 'undefined') {
    var nonce =  true ? __webpack_require__.nc : undefined;

    if (nonce) {
      options.attributes.nonce = nonce;
    }
  }

  Object.keys(options.attributes).forEach(function (key) {
    style.setAttribute(key, options.attributes[key]);
  });

  if (typeof options.insert === 'function') {
    options.insert(style);
  } else {
    var target = getTarget(options.insert || 'head');

    if (!target) {
      throw new Error("Couldn't find a style target. This probably means that the value for the 'insert' parameter is invalid.");
    }

    target.appendChild(style);
  }

  return style;
}

function removeStyleElement(style) {
  // istanbul ignore if
  if (style.parentNode === null) {
    return false;
  }

  style.parentNode.removeChild(style);
}
/* istanbul ignore next  */


var replaceText = function replaceText() {
  var textStore = [];
  return function replace(index, replacement) {
    textStore[index] = replacement;
    return textStore.filter(Boolean).join('\n');
  };
}();

function applyToSingletonTag(style, index, remove, obj) {
  var css = remove ? '' : obj.css; // For old IE

  /* istanbul ignore if  */

  if (style.styleSheet) {
    style.styleSheet.cssText = replaceText(index, css);
  } else {
    var cssNode = document.createTextNode(css);
    var childNodes = style.childNodes;

    if (childNodes[index]) {
      style.removeChild(childNodes[index]);
    }

    if (childNodes.length) {
      style.insertBefore(cssNode, childNodes[index]);
    } else {
      style.appendChild(cssNode);
    }
  }
}

function applyToTag(style, options, obj) {
  var css = obj.css;
  var media = obj.media;
  var sourceMap = obj.sourceMap;

  if (media) {
    style.setAttribute('media', media);
  }

  if (sourceMap && btoa) {
    css += "\n/*# sourceMappingURL=data:application/json;base64,".concat(btoa(unescape(encodeURIComponent(JSON.stringify(sourceMap)))), " */");
  } // For old IE

  /* istanbul ignore if  */


  if (style.styleSheet) {
    style.styleSheet.cssText = css;
  } else {
    while (style.firstChild) {
      style.removeChild(style.firstChild);
    }

    style.appendChild(document.createTextNode(css));
  }
}

var singleton = null;
var singletonCounter = 0;

function addStyle(obj, options) {
  var style;
  var update;
  var remove;

  if (options.singleton) {
    var styleIndex = singletonCounter++;
    style = singleton || (singleton = insertStyleElement(options));
    update = applyToSingletonTag.bind(null, style, styleIndex, false);
    remove = applyToSingletonTag.bind(null, style, styleIndex, true);
  } else {
    style = insertStyleElement(options);
    update = applyToTag.bind(null, style, options);

    remove = function remove() {
      removeStyleElement(style);
    };
  }

  update(obj);
  return function updateStyle(newObj) {
    if (newObj) {
      if (newObj.css === obj.css && newObj.media === obj.media && newObj.sourceMap === obj.sourceMap) {
        return;
      }

      update(obj = newObj);
    } else {
      remove();
    }
  };
}

module.exports = function (list, options) {
  options = options || {};
  options.attributes = typeof options.attributes === 'object' ? options.attributes : {}; // Force single-tag solution on IE6-9, which has a hard limit on the # of <style>
  // tags it will allow on a page

  if (!options.singleton && typeof options.singleton !== 'boolean') {
    options.singleton = isOldIE();
  }

  var styles = listToStyles(list, options);
  addStylesToDom(styles, options);
  return function update(newList) {
    var mayRemove = [];

    for (var i = 0; i < styles.length; i++) {
      var item = styles[i];
      var domStyle = stylesInDom[item.id];

      if (domStyle) {
        domStyle.refs--;
        mayRemove.push(domStyle);
      }
    }

    if (newList) {
      var newStyles = listToStyles(newList, options);
      addStylesToDom(newStyles, options);
    }

    for (var _i = 0; _i < mayRemove.length; _i++) {
      var _domStyle = mayRemove[_i];

      if (_domStyle.refs === 0) {
        for (var j = 0; j < _domStyle.parts.length; j++) {
          _domStyle.parts[j]();
        }

        delete stylesInDom[_domStyle.id];
      }
    }
  };
};

/***/ }),

/***/ "./src/styles.css":
/*!************************!*\
  !*** ./src/styles.css ***!
  \************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

var content = __webpack_require__(/*! !../node_modules/@angular-devkit/build-angular/src/angular-cli-files/plugins/raw-css-loader.js!../node_modules/postcss-loader/src??embedded!./styles.css */ "./node_modules/@angular-devkit/build-angular/src/angular-cli-files/plugins/raw-css-loader.js!./node_modules/postcss-loader/src/index.js?!./src/styles.css");

if (typeof content === 'string') {
  content = [[module.i, content, '']];
}

var options = {}

options.insert = "head";
options.singleton = false;

var update = __webpack_require__(/*! ../node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js */ "./node_modules/style-loader/dist/runtime/injectStylesIntoStyleTag.js")(content, options);

if (content.locals) {
  module.exports = content.locals;
}


/***/ }),

/***/ 3:
/*!******************************!*\
  !*** multi ./src/styles.css ***!
  \******************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\xampp\htdocs\magikqrcode\src\styles.css */"./src/styles.css");


/***/ })

},[[3,"runtime"]]]);
//# sourceMappingURL=styles-es2015.js.map