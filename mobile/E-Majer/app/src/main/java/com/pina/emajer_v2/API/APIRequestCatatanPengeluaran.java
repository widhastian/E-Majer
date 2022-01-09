package com.pina.emajer_v2.API;

import com.pina.emajer_v2.Model.CatatanPengeluaran.DataPengeluaranResponse;
import com.pina.emajer_v2.Model.PembayaranKas.DataMingguResponse;

import retrofit2.Call;
import retrofit2.http.Field;
import retrofit2.http.FormUrlEncoded;
import retrofit2.http.POST;

public interface APIRequestCatatanPengeluaran {
    @FormUrlEncoded
    @POST("pengeluaran/catatanPengeluaran.php?fungsi=get_all_pengeluaran")
    Call<DataPengeluaranResponse> ambilAllPengeluaran(
            @Field("id_kelas") String id_kelas
    );

    @FormUrlEncoded
    @POST("pengeluaran/catatanPengeluaran.php?fungsi=get_pengeluaran")
    Call<DataPengeluaranResponse> ambilPengeluaran(
            @Field("id_pengeluaran") String id_pengeluaran
    );

    @FormUrlEncoded
    @POST("pengeluaran/catatanPengeluaran.php?fungsi=get_detail_pengeluaran")
    Call<DataPengeluaranResponse> ambilDetailPengeluaran(
            @Field("id_pengeluaran") String id_pengeluaran
    );
}
