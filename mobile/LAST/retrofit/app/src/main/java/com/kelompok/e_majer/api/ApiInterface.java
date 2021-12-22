package com.kelompok.e_majer.api;

import com.kelompok.e_majer.model.ResponseModel;
import com.kelompok.e_majer.model.login.Login;
import com.kelompok.e_majer.model.register.Register;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface ApiInterface {

    @FormUrlEncoded
    @POST("login.php")
    Call<Login> loginResponse(
            @Field("email") String email,
            @Field("password") String password
    );

    @FormUrlEncoded
    @POST("register.php")
    Call<Register> registerResponse(
            @Field("email") String email,
            @Field("username") String username,
            @Field("password") String password,
            @Field("nama") String nama,
            @Field("kelas") String kelas
    );

    @FormUrlEncoded
    @POST("update.php")
    Call<ResponseModel> ardUpdateData(
            @Field("id_akun") String id_akun,
            @Field("nama") String nama,
            @Field("email") String email,
            @Field("username") String username,
            @Field("password") String password,
            @Field("id_kelas") String id_kelas
    );

    @FormUrlEncoded
    @POST("get.php")
    Call<ResponseModel> ardGetData(
            @Field("id_akun") String id_akun
    );

}

