package com.pina.emajer_v2.API;

import com.pina.emajer_v2.Model.PembayaranKas.DataMingguResponse;
import com.pina.emajer_v2.Model.PembayaranKas.Transaksi;
import com.pina.emajer_v2.Model.PembayaranKas.TransaksiResponse;

import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface APIRequestPembayaranKas {

    @FormUrlEncoded
    @POST("transaksi/pembayaranKas.php?fungsi=get_minggu_id")
    Call<DataMingguResponse> ambilMinggu(
            @Field("id") String id
    );

    @POST("transaksi/pembayaranKas.php?fungsi=input_transaksi")
    Call<TransaksiResponse> kirimTransaksi(@Body Transaksi transaksi);
}
