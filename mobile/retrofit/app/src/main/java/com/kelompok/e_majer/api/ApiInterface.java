package com.kelompok.e_majer.api;

import com.kelompok.e_majer.User;
import com.kelompok.e_majer.model.login.Login;
import com.kelompok.e_majer.model.register.Register;

import okhttp3.Request;
import retrofit2.Call;
import retrofit2.http.Body;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.GET;
import retrofit2.http.POST;

public interface ApiInterface {

    @GET("User_Registration.php")
    Call<UserResponse> getUser();

    @POST("User_Registration.php")
    Call<Request> sendUser(@Body User user);
//    @FormUrlEncoded
//    @POST("login.php")
//    Call<Login> loginResponse(
//            @Field("email") String email,
//            @Field("password") String password
//    );

//    @FormUrlEncoded
//    @POST("register.php")
//    Call<Register> registerResponse(
//            @Field("email") String email,
//            @Field("password") String password,
//            @Field("name") String name,
//            String kelas);

}

