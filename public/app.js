$(document).ready(function () {
    addEventListenersToRow($('.teklif-satir:first'));
});

document.getElementById('satirekle').addEventListener('click', function () {
    var newLine = $('.teklif-satir:first').clone();

    // inputları sıfırlar
    newLine.find('input').val('');
    newLine.find('select[name="kdvtip[]"]').val('0');

    // satır numaralarını yeniden atama yapıyoruz ki satır no karışmasın
    var rowCount = $('.teklif-satir').length + 1;
    newLine.find('input[id="no"]').val(rowCount);

    // yeni satır ekleme fonksiyonu
    addEventListenersToRow(newLine);

    // satırı formun sonuna ekleme
    $('.teklif-satirlar').append(newLine);
});

function addEventListenersToRow(row) {
    row.find('select[name="kdvtip[]"], input[id="adet"], input[id="birimfiyat"], input[id="iskonto"]').on('input', function () {
        calculateValues(row);
    });
}

function calculateValues(row) {
    var adet = parseFloat(row.find('input[id="adet"]').val()) || 0;
    var birimFiyat = parseFloat(row.find('input[id="birimfiyat"]').val()) || 0;
    var iskonto = parseFloat(row.find('input[id="iskonto"]').val()) || 0;
    var selectedKDV = parseInt(row.find('select[name="kdvtip[]"]').val());

    var kdvOrani = selectedKDV / 100;
    var toplamKDV = adet * birimFiyat * kdvOrani;
    var toplamIskonto = (adet * birimFiyat * iskonto) / 100;
    var toplamFiyat = adet * birimFiyat + toplamKDV - toplamIskonto;

    // hesapladığımız değerleri yazdırıp input value değerlerine atıyoruz
    row.find('input[id="toplamkdv"]').val(toplamKDV.toFixed(2));
    row.find('input[id="toplamiskonto"]').val(toplamIskonto.toFixed(2));
    row.find('input[id="toplamfiyat"]').val(toplamFiyat.toFixed(2));

    // satır numaralarını üstteki fonksyiondan çekip indis no arttırarak kaydediyoruz
    var rowCount = row.index() + 1;
    row.find('input[id="no"]').val(rowCount);
}
