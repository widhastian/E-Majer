package com.pina.emajer_v2.API;

import com.pina.emajer_v2.Model.ResponseModel;
import com.pina.emajer_v2.Model.register.Register;

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
