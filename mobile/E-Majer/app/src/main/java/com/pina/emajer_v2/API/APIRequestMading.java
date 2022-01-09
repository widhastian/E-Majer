package com.pina.emajer_v2.API;

import com.pina.emajer_v2.Model.Mading.MadingResponse;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface APIRequestMading {
    @FormUrlEncoded //Kalo pake @Field harus pake @FormUrlEncoded
    @POST("mading/mading.php?fungsi=get_all_mading")
    Call<MadingResponse> ambilMading(@Field("id") String id);
}
