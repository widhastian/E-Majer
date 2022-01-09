package com.pina.emajer_v2.API;

import com.pina.emajer_v2.Model.ResponseModel;
import com.pina.emajer_v2.Model.barang.DataBarangResponse;

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
