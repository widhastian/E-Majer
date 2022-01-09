package com.kelompok.emajer.API;

import com.kelompok.emajer.Model.RiwayatTransaksi.RiwayatResponse;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface APIRequestRiwayatTransaksi {

    @FormUrlEncoded //Kalo pake @Field harus pake @FormUrlEncoded
    @POST("transaksi/riwayatTransaksi.php?fungsi=get_all_transaksi")
    Call<RiwayatResponse> ambilRiwayatTrans(@Field("id") String id);
}
