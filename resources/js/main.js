$(document).ready(function() {
    // احصل على سعر الغرفة
    const roomPrice = parseFloat($('#room_price').val());
    let totalPrice = roomPrice;

    // عرض السعر الإجمالي الأولي (سعر الغرفة فقط)
    $('#total_price').val('$' + totalPrice.toFixed(2));

    // تحديث السعر الإجمالي عند تغيير الخدمات
    $('input[type="checkbox"]').change(function() {
        totalPrice = roomPrice; // إعادة تعيين السعر الإجمالي إلى سعر الغرفة

        // إضافة أسعار الخدمات المختارة
        $('input[type="checkbox"]:checked').each(function() {
            totalPrice += parseFloat($(this).data('price'));
        });

        // عرض السعر الإجمالي
        $('#total_price').val('$' + totalPrice.toFixed(2));
    });
});