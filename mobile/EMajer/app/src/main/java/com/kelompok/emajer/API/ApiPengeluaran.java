package com.kelompok.emajer.API;

import com.kelompok.emajer.Model.ResponseModel;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface ApiPengeluaran {
    @FormUrlEncoded
    @POST("pengeluaran/saldo.php")
    Call<ResponseModel> ardGetDataSaldo(
            @Field("id_kelas") String id_kelas
    );

}
