package com.pina.emajer_v2.API;

import com.pina.emajer_v2.Model.ResponseModel;
import com.pina.emajer_v2.Model.login.Login;
import com.pina.emajer_v2.Model.register.Register;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface ApiLoginRegister {

    @FormUrlEncoded
    @POST("login/login.php")
    Call<Login> loginResponse(
            @Field("email") String email,
            @Field("password") String password
    );

    @FormUrlEncoded
    @POST("register/register.php")
    Call<Register> registerResponse(
            @Field("nama") String nama,
            @Field("email") String email,
            @Field("username") String username,
            @Field("password") String password,
            @Field("id_kelas") String kelas
    );

    @FormUrlEncoded
    @POST("editprofil/update.php")
    Call<ResponseModel> ardUpdateData(
            @Field("id_akun") String id_akun,
            @Field("nama") String nama,
            @Field("email") String email,
            @Field("username") String username,
            @Field("password") String password,
            @Field("id_kelas") String id_kelas
    );

    @FormUrlEncoded
    @POST("editprofil/get.php")
    Call<ResponseModel> ardGetData(
            @Field("id_akun") String id_akun
    );

}

