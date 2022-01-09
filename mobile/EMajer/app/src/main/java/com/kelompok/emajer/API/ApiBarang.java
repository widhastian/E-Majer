package com.kelompok.emajer.API;

import com.kelompok.emajer.Model.barang.DataBarangResponse;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface ApiBarang {
    @FormUrlEncoded
    @POST("barang/barang.php?fungsi=get_all_barang")
    Call<DataBarangResponse> ardGetData(
            @Field("id") String id
    );
}
