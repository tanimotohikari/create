
function createItems(data) {
  $('#js−search-result').empty();

  var pageCount = data.pageCount;
  var current = data.page;
  var dataStat = data.count;
  if (dataStat > 0) {
  $.each(data.Items, function (i, items) {
  var item = items.Item;
  var affiliateUrl = item.affiliateUrl;
  var imageUrl = item.mediumImageUrls[0].imageUrl;
  var itemName = item.itemName;
  if (itemName.length > 50) {
  itemName = itemName.substring(0, 50) + '...';
  　}
  var itemPrice = item.itemPrice;
  var itemReviewAverage = item.reviewAverage;
  var itemShopName = item.shopName;
  var htmlTemplate = $('<div class="card">' +
  '<a class="card-link" href="' + affiliateUrl + '">' +
  '<div class="card-inner">' +
  '<div class="card-thumbnail-wrapper l-card-bottom-small">' +
  '<img class="card-thumbnail" src="' + imageUrl + '" alt="' + item.itemName + '" width="150" ' +
  'height="150"/>' +
  '</div>' +
  '<h2 class="card-title text-strong l-card-bottom-small">' + itemName + '</h2>' +
  '<div class="card-shop l-card-bottom-small">' + itemShopName + '</div>' +
  '<div class="clearfix">' +
  '<div class="l-right"><p class="card-price text-price text-strong">' + itemPrice + '円</p></div>' +
  '<div class="l-left"><p class="card-review text-review">評価：' + '<span class="text-strong">' + itemReviewAverage + '点</span></p></div>' +
  '</div>' +
  '</div>' +
  '</a>' +
  '</div>');

  //テンプレートを追加
  $('#js−search-result').append(htmlTemplate);
  });
  }
}