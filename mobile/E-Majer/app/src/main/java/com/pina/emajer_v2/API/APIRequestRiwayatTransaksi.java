package com.pina.emajer_v2.API;

import com.pina.emajer_v2.Model.RiwayatTransaksi.RiwayatResponse;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface APIRequestRiwayatTransaksi {

    @FormUrlEncoded //Kalo pake @Field harus pake @FormUrlEncoded
    @POST("transaksi/riwayatTransaksi.php?fungsi=get_all_transaksi")
    Call<RiwayatResponse> ambilRiwayatTrans(@Field("id") String id);
}
