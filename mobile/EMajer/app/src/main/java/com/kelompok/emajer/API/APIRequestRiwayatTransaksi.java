package com.kelompok.emajer.API;

import android.util.TypedValue;

import com.kelompok.emajer.Model.RiwayatTransaksi.RiwayatResponse;
import com.kelompok.emajer.Model.RiwayatTransaksi.Upload_gambar;

import okhttp3.MultipartBody;
import okhttp3.RequestBody;
import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.Multipart;
import retrofit2.http.POST;
import retrofit2.http.Part;
import retrofit2.http.Query;

public interface APIRequestRiwayatTransaksi {

    @FormUrlEncoded //Kalo pake @Field harus pake @FormUrlEncoded
    @POST("transaksi/riwayatTransaksi.php?fungsi=get_all_transaksi")
    Call<RiwayatResponse> ambilRiwayatTrans(@Field("id") String id);

    @Multipart
    @POST("transaksi/upload_gambar.php")
    Call<Upload_gambar> uploadImage(
            @Part MultipartBody.Part id,
            @Part MultipartBody.Part image);
}

